# AGENT.md — Redesign Admin Panel CMS

## 1. Ringkasan Project

Redesign total tampilan **admin panel (backend)** dari sebuah CMS. Bagian auth (login/register) sudah dibuat sebelumnya dan **tidak diubah** — fokus redesign ada di layout dashboard/admin setelah user login.

Prinsip utama pengerjaan:

- **Cek kode/struktur lama dulu** sebelum menambah file baru — jangan duplikat komponen yang fungsinya sudah ada.
- **Clean code & efisien** — hindari class Tailwind yang berulang-ulang ditulis manual di banyak file.
- **Reusable component** — apapun yang muncul di lebih dari 1 halaman (button, card, table, badge, dll) WAJIB jadi Blade Component, bukan copy-paste.

## 2. Tech Stack

| Layer              | Tools                                                                                                                          |
| ------------------ | ------------------------------------------------------------------------------------------------------------------------------ |
| Backend            | Laravel 11                                                                                                                     |
| Styling            | Tailwind CSS v4 (`@tailwindcss/vite`, CSS-first config via `@theme`)                                                           |
| Icon               | Remix Icon (`remixicon` — pakai class `ri-*`)                                                                                  |
| Komponen           | Blade Components (`x-component`)                                                                                               |
| Data Table         | Yajra Laravel DataTables + DataTables.js           |
| Form Enhancement   | Select2 (`select2` — searchable select, multi-select, tagging)                                                                 |
| Alert & Dialog     | SweetAlert2 (`sweetalert2` — alert, konfirmasi, toast notification)                                                            |
| Chart (Opsional)   | ApexCharts — direkomendasikan karena ringan & gampang di-theme pakai CSS variable, cocok sama pendekatan CSS-first Tailwind v4 |
| JavaScript         | Vanilla JavaScript (ES6+)                                                                                                      |
| Build Tool         | Vite                                                                                                                           |

> **Catatan Tailwind v4:** Konfigurasi warna, font, dan design token dilakukan lewat `@theme` di file CSS utama (bukan lagi `tailwind.config.js` untuk sebagian besar kasus). Sesuaikan bagian ini kalau project kamu masih memakai konfigurasi Tailwind versi sebelumnya.

## 3. Struktur Folder yang Disarankan

```
resources/
  views/
    layouts/
      backend/
        main.blade.php          # layout utama admin (sidebar+header+body+footer+breadcumrd)
    components/
      layout/
        admin/
            sidebar.blade.php
            header.blade.php
            footer.blade.php
            breadcrumb.blade.php
            children.blade.php     # recursive helper untuk menu nested
      ui/
        button.blade.php
        google-button.blade.php
        input.blade.php
        password.blade.php
    dashboard/
      index.blade.php
    auth/
      ...halaman auth ada di sini
```

> Catatan: struktur ini sejajar dengan folder view yang sudah ada. `layouts/backend/main.blade.php` tetap jadi wrapper admin, sementara potongan layout disimpan di `components/layout/`.

## 4. Scope Pengerjaan

### 4.1 Layout Backend (Admin Panel)

- [ ] `layouts/backend/main.blade.php` — Layout utama Admin Panel (Sidebar, Header, Breadcrumb, Content, Footer)
- [ ] `x-layout.admin.sidebar` — Sidebar navigasi, mendukung active state dan submenu (collapsible jika diperlukan)
- [ ] `x-layout.admin.header` — Header / Topbar (Search, Notification, Profile Dropdown)
- [ ] `x-layout.admin.breadcrumb` — Breadcrumb dinamis, menerima prop `items`

      [
          ['label' => 'Dashboard', 'url' => route('dashboard')],
          ['label' => 'User', 'url' => route('users.index')],
          ['label' => 'Create', 'url' => null],
      ]

- [ ] `x-layout.admin.children`
  - Bertugas merender menu anak (`children`) secara rekursif.
  - Digunakan oleh `x-layout.admin.sidebar`.
  - Mendukung nested menu tanpa batas level.
  - Mengikuti permission (`@can`) dan active state.
- [ ] `x-layout.admin.footer` — Footer Admin (Copyright, Versi Aplikasi)


### 4.2 Chart (Opsional)

- [ ] `x-admin.chart` — wrapper ApexCharts, terima props `type` (line/bar/donut) dan `data` (array/JSON) supaya bisa dipakai ulang di halaman manapun tanpa nulis ulang script inisialisasi

## 5. Aturan Kerja untuk AI/Developer

1. **Selalu cek dulu** apakah komponen serupa sudah ada di `resources/views/components/` sebelum bikin baru.
2. Semua styling pakai **utility class Tailwind v4** langsung di Blade — hindari inline `<style>` kecuali benar-benar perlu.
3. Icon pakai Remix Icon: `<i class="ri-dashboard-line"></i>` — jangan campur dengan icon library lain.
4. Props Blade Component pakai `@props([...])` dengan default value yang jelas.
5. Jangan sentuh/ubah logic auth yang sudah ada — redesign murni di sisi tampilan admin panel setelah login.
6. Penamaan file & komponen: `kebab-case`, dikelompokkan per folder (`admin.*` untuk layout/UI, `forms.*` untuk elemen form).
7. Konsisten warna & spacing: definisikan token warna sekali di `@theme` (CSS), semua komponen pakai token itu — jangan hex code lepas di tiap file.

## 6. Belum Diputuskan / Perlu Info Tambahan

- Isi kode auth & layout lama belum di-review langsung — sebaiknya ditempel/upload supaya konvensi (penamaan, struktur folder existing) bisa disamakan, bukan dibuat dari asumsi.
- Skema warna/branding admin panel belum ditentukan.
