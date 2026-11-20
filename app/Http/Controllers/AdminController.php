<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\HomepageDeskripsi;
use App\Models\AboutMe;
use App\Models\Skill;
use App\Models\Portofolio;
use App\Models\Kontak;
use App\Models\User;

class AdminController extends Controller
{
    // 1. Tampilkan Halaman Dashboard
    public function index()
    {
        $user = User::first();
        $homepage = HomepageDeskripsi::first();
        $about = AboutMe::first();
        $contact = Kontak::find(1) ?? Kontak::whereNull('pesan_pengirim')->first();
        $skills = Skill::latest()->get();
        $portfolios = Portofolio::latest()->get();
        $messages = Kontak::whereNotNull('pesan_pengirim')->latest()->get();
        
        return view('admin.dashboard', compact('user', 'homepage', 'about', 'contact', 'skills', 'portfolios', 'messages'));
    }

    // 2. Simpan Profile (User)
    public function updateProfile(Request $request)
    {
        $user = User::first() ?: new User();
        if (!$user->password) $user->password = bcrypt('password123');

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
            'alamat' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'link_github' => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cv' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) Storage::delete('public/' . $user->foto_profil);
            $validated['foto_profil'] = $request->file('foto_profil')->store('profiles', 'public');
        }
        if ($request->hasFile('cv')) {
            if ($user->cv) Storage::delete('public/' . $user->cv);
            $validated['cv'] = $request->file('cv')->store('cv', 'public');
        }

        $user->name = $validated['nama'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }
        $user->alamat = $validated['alamat'] ?? null;
        $user->status = $validated['status'] ?? null;
        $user->link_github = $validated['link_github'] ?? null;
        if (isset($validated['foto_profil'])) $user->foto_profil = $validated['foto_profil'];
        if (isset($validated['cv'])) $user->cv = $validated['cv'];

        $user->save();
        return back()->with('success', 'Profile berhasil diperbarui!');
    }

    // 3. Simpan Homepage
    public function updateHomepage(Request $request)
    {
        $data = $request->validate([
            'role' => 'required|string|max:255',
            'judul_deskripsi' => 'required|string',
            'catatan_utama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);
        HomepageDeskripsi::updateOrCreate(['id' => 1], $data);
        return back()->with('success', 'Homepage berhasil diperbarui!');
    }

    // 4. Simpan About Me
    public function updateAbout(Request $request)
    {
        $about = AboutMe::first() ?: new AboutMe();
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'judul_detail' => 'nullable|string|max:255',
            'deskripsi_detail' => 'nullable|string',
            'aboutme_gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        if ($request->hasFile('aboutme_gambar')) {
            if ($about->aboutme_gambar) Storage::delete('public/' . $about->aboutme_gambar);
            $data['aboutme_gambar'] = $request->file('aboutme_gambar')->store('about', 'public');
        }

        $about->fill($data)->save();
        return back()->with('success', 'About Me berhasil diperbarui!');
    }

    // 5. Simpan Skill Baru
    public function storeSkill(Request $request)
    {
        $data = $request->validate([
            'skill_judul' => 'required|string|max:255',
            'emoji' => 'required|string|max:50',
            'judul_perskill' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,expert'
        ]);
        
        $data['isi_skill'] = $data['judul_perskill'];
        Skill::create($data);
        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    // 6. Hapus Skill
    public function deleteSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return back()->with('success', 'Skill berhasil dihapus!');
    }

    // 6b. Update Skill
    public function updateSkill(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $data = $request->validate([
            'skill_judul' => 'required|string|max:255',
            'emoji' => 'required|string|max:50',
            'judul_perskill' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,expert'
        ]);

        $data['isi_skill'] = $data['judul_perskill'];
        $skill->update($data);

        return back()->with('success', 'Skill berhasil diperbarui!');
    }

    // 7. Simpan Portfolio Baru
    public function storePortfolio(Request $request)
    {
        $data = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'kategori' => 'required|in:project,organization,certificate',
            'judul_isi' => 'nullable|string|max:255',
            'deskripsi_isi' => 'nullable|string'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('portfolios', 'public');
        }

        Portofolio::create($data);
        return back()->with('success', 'Portfolio berhasil ditambahkan!');
    }

    // 7b. Update Portfolio
    public function updatePortfolio(Request $request, $id)
    {
        $portfolio = Portofolio::findOrFail($id);

        $data = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'kategori' => 'required|in:project,organization,certificate',
            'judul_isi' => 'nullable|string|max:255',
            'deskripsi_isi' => 'nullable|string'
        ]);

        if ($request->hasFile('foto')) {
            if ($portfolio->foto) {
                Storage::delete('public/' . $portfolio->foto);
            }
            $data['foto'] = $request->file('foto')->store('portfolios', 'public');
        }

        $portfolio->update($data);
        return back()->with('success', 'Portfolio berhasil diperbarui!');
    }

    // 8. Hapus Portfolio
    public function deletePortfolio($id)
    {
        $portfolio = Portofolio::findOrFail($id);
        if ($portfolio->foto) {
            Storage::delete('public/' . $portfolio->foto);
        }
        $portfolio->delete();
        return back()->with('success', 'Portfolio berhasil dihapus!');
    }

    // 9. Simpan Contact Settings
    public function updateContact(Request $request)
    {
        $data = $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi_singkat' => 'nullable|string',
            'media_sosial' => 'nullable|string',
            'link_github' => 'nullable|string|max:255',
            'link_linkedin' => 'nullable|string|max:255',
            'link_instagram' => 'nullable|string|max:255'
        ]);

        $links = array_filter([$data['link_github'] ?? null, $data['link_linkedin'] ?? null, $data['link_instagram'] ?? null]);
        if (!empty($links)) {
            $data['media_sosial'] = implode(', ', $links);
        }

        Kontak::updateOrCreate(['id' => 1], $data);

        // Sinkronkan juga link_github ke User jika diisi
        if (!empty($data['link_github'])) {
            $user = User::first();
            if ($user) {
                $user->link_github = $data['link_github'];
                $user->save();
            }
        }

        return back()->with('success', 'Pengaturan kontak dan link media sosial berhasil diperbarui!');
    }

    // 10. Hapus Pesan Masuk
    public function deleteMessage($id)
    {
        $message = Kontak::findOrFail($id);
        $message->delete();
        return back()->with('success', 'Pesan berhasil dihapus!');
    }
}
