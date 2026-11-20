<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomepageDeskripsi;
use App\Models\AboutMe;
use App\Models\Skill;
use App\Models\Portofolio;
use App\Models\Kontak;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = User::first(); 
        $homepage = HomepageDeskripsi::first();
        $about = AboutMe::first();
        $skills = Skill::all();
        $portfolios = Portofolio::latest()->get();
        $contact = Kontak::find(1) ?? Kontak::whereNull('pesan_pengirim')->first();

        $stats = [
            'projects' => Portofolio::where('kategori', 'project')->count(),
            'organizations' => Portofolio::where('kategori', 'organization')->count(),
            'certificates' => Portofolio::where('kategori', 'certificate')->count(),
        ];

        return view('portfolio', compact('user', 'homepage', 'about', 'skills', 'portfolios', 'contact', 'stats'));
    }

    public function sendContact(Request $request)
    {
        $disposableDomains = [
            'mailinator.com', 'tempmail.com', '10minutemail.com', 'guerrillamail.com',
            'yopmail.com', 'sharklasers.com', 'dispostable.com', 'trashmail.com',
            'getairmail.com', 'throwawaymail.com', 'fakeinbox.com', 'mohmal.com',
            'emailondeck.com', 'temp-mail.org', 'crazymailing.com', 'dropmail.me',
            'example.com', 'test.com', 'domain.com', 'asdf.com'
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                function ($attribute, $value, $fail) use ($disposableDomains) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        return;
                    }

                    $domain = strtolower(substr(strrchr($value, "@"), 1));
                    if (empty($domain)) {
                        return;
                    }

                    // 1. Cek apakah domain termasuk email sementara (disposable email)
                    if (in_array($domain, $disposableDomains)) {
                        $fail('Mohon gunakan alamat email asli (bukan email sementara / fake email).');
                        return;
                    }

                    // 2. Cek apakah domain memiliki server email (MX / A Record) aktif
                    if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
                        $fail('Domain email tidak ditemukan atau tidak memiliki server email aktif. Harap masukkan email asli.');
                    }
                }
            ],
            'message' => 'required|string|min:5',
        ], [
            'name.required' => 'Nama pengirim wajib diisi.',
            'email.required' => 'Email pengirim wajib diisi.',
            'email.email' => 'Format email atau domain tidak valid. Pastikan Anda memasukkan email asli yang aktif.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal terdiri dari 5 karakter.'
        ]);

        Kontak::create([
            'nama_pengirim' => $request->name,
            'email_pengirim' => $request->email,
            'pesan_pengirim' => $request->message,
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim! Saya akan segera membalasnya.');
    }
}
