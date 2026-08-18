# Flowchart Aplikasi AppBencana

## 1. Diagram Alur Utama (Main Flow)

```mermaid
flowchart TB
    subgraph AUTH["🔐 AUTENTIKASI"]
        A1[👤 Halaman Login] --> A2{Cek Kredensial}
        A2 -->|Valid| A3[🎯 Redirect ke Dashboard]
        A2 -->|Invalid| A4[❌ Pesan Error]
        A4 --> A1
    end

    subgraph MAIN["📋 MENU UTAMA"]
        M1[🏠 Dashboard] --> M2[📊 Statistik]
        M1 --> M3[📋 Bencana]
        M1 --> M4[👥 Korban]
        M1 --> M5[🏥 Triase]
        M1 --> M6[💉 Pemeriksaan]
        M1 --> M7[🔄 Rujukan]
        M1 --> M8[🏨 Rumah Sakit]
        M1 --> M9[👤 User]
        M1 --> M10[📄 Laporan]
        M1 --> M11[📚 API Docs]
    end

    A3 --> M1
```

## 2. Alur CRUD Standar

```mermaid
flowchart LR
    subgraph CRUD["🔄 CRUD Process"]
        direction TB
        C1[📋 Index/List] --> C2[➕ Create]
        C2 --> C3[💾 Simpan Data]
        C3 --> C4{✓ Berhasil?}
        C4 -->|Ya| C5[✅ Redirect ke Index]
        C4 -->|Tidak| C6[❌ Tampilkan Error]
        C6 --> C2
        C5 --> C7[👁️ Show Detail]
        C7 --> C8[✏️ Edit]
        C8 --> C9[💾 Update Data]
        C9 --> C10{✓ Berhasil?}
        C10 -->|Ya| C5
        C10 -->|Tidak| C11[❌ Tampilkan Error]
        C11 --> C8
        C7 --> C12[🗑️ Delete]
        C12 --> C13{Hapus?}
        C13 -->|Ya| C14[✅ Hapus & Refresh]
        C13 -->|Tidak| C15[↩️ Kembali]
    end
```

## 3. Alur Bisnis Utama (Business Flow)

```mermaid
flowchart TB
    subgraph B1["📝 PENCATATAN BENCANA"]
        B1A[🌊 Buat Bencana Baru] --> B1B[📍 Lokasi]
        B1B --> B1C[📅 Tanggal]
        B1C --> B1D[📊 Jenis Bencana]
        B1D --> B1E[⚡ Status: Aktif/Selesai]
        B1E --> B1F[✅ Simpan ke Database]
    end

    subgraph B2["👥 PENDATAAN KORBAN"]
        B2A[🏥 Data Korban Baru] --> B2B[🔗 Pilih Bencana]
        B2B --> B2C[👤 Nama]
        B2C --> B2D[⚧️ Jenis Kelamin]
        B2D --> B2E[🎂 Umur]
        B2E --> B2F[📋 Status Identitas]
        B2F --> B2G[📍 Lokasi Ditemukan]
        B2G --> B2H[💾 Simpan Korban]
    end

    subgraph B3["🏥 TRIASE (Pengklasifikasian)"]
        B3A[📋 Pilih Korban] --> B3B[🔍 Assessment]
        B3B --> B3C{Prioritas?}
        B3C -->|🔴 Merah<br/>Immediate| B3D[Prioritas Tinggi<br/>Perlu Penanganan Segera]
        B3C -->|🟡 Kuning<br/>Delayed| B3E[Prioritas Sedang<br/>Bisa Ditunda]
        B3C -->|🟢 Hijau<br/>Walking Wounded| B3F[Prioritas Rendah<br/>Bisa Jalan]
        B3C -->|⚫ Hitam<br/>Dead| B3G[Meninggal<br/>Tidak Perlu Penanganan]
        B3D --> B3H[💾 Simpan Triase]
        B3E --> B3H
        B3F --> B3H
        B3G --> B3H
    end

    subgraph B4["💉 PEMERIKSAAN MEDIS"]
        B4A[📋 Pilih Korban] --> B4B[📝 Identitas Pasien]
        B4B --> B4C[💓 Vital Sign]
        B4C --> B4D{Tekanan Darah<br/>Nadi<br/>Respirasi<br/>Suhu}
        B4D --> B4E[🔬 Primary Survey]
        B4E --> B4F{Airway<br/>Breathing<br/>Circulation<br/>Disability<br/>Exposure}
        B4F --> B4G[📋 Diagnosis Awal]
        B4G --> B4H[💊 Tindakan]
        B4H --> B4I[💾 Simpan Pemeriksaan]
    end

    subgraph B5["🔄 RUJUKAN"]
        B5A[📋 Pilih Korban] --> B5B[🏨 Pilih Rumah Sakit]
        B5B --> B5C[📝 Catatan]
        B5C --> B5D[⏰ Waktu Rujuk]
        B5D --> B5E{Status?}
        B5E -->|📤 Dirujuk| B5F[Menunggu Konfirmasi]
        B5E -->|✅ Diterima| B5G[RS Konfirmasi]
        B5E -->|🏁 Selesai| B5H[Proses Selesai]
        B5F --> B5I[💾 Simpan Rujukan]
        B5G --> B5I
        B5H --> B5I
    end

    B1F --> B2A
    B2H --> B3A
    B3H --> B4A
    B4I --> B5A
```

## 4. Alur API Mobile Application

```mermaid
flowchart TB
    subgraph API_AUTH["🔐 API Authentication"]
        API1[📱 Mobile App] --> API2{Login?}
        API2 -->|Ya| API3[POST /api/login]
        API3 --> API4[🔑 Token Sanctum]
        API2 -->|Logout| API5[POST /api/logout]
        API5 --> API6[🗑️ Hapus Token]
    end

    subgraph API_BENCANA["🌊 API Bencana"]
        API7[GET /api/bencana] --> API8[📋 List Semua Bencana]
        API7 --> API9[POST /api/bencana] --> API10[➕ Buat Bencana]
        API7 --> API11[GET /api/bencana/{id}] --> API12[👁️ Detail]
        API7 --> API12 --> API13[PUT /api/bencana/{id}] --> API14[✏️ Update]
        API7 --> API12 --> API15[DELETE /api/bencana/{id}] --> API16[🗑️ Hapus]
    end

    subgraph API_KORBAN["👥 API Korban"]
        API20[GET /api/korban] --> API21[📋 List]
        API20 --> API22[GET /api/korban/by-user] --> API23[👤 By User Login]
        API20 --> API24[POST /api/korban] --> API25[➕ Tambah]
        API20 --> API26[GET /api/korban/{id}] --> API27[👁️ Detail]
        API20 --> API26 --> API28[PUT /api/korban/{id}] --> API29[✏️ Update]
        API20 --> API26 --> API30[DELETE /api/korban/{id}] --> API31[🗑️ Hapus]
    end

    subgraph API_TRIASE["🏥 API Triase"]
        API40[GET /api/triase] --> API41[📋 List]
        API40 --> API42[GET /api/triase/by-user] --> API43[👤 By User]
        API40 --> API44[POST /api/triase] --> API45[➕ Assessment]
        API40 --> API46[GET /api/triase/{id}] --> API47[👁️ Detail]
        API40 --> API46 --> API48[PUT /api/triase/{id}] --> API49[✏️ Update]
        API40 --> API46 --> API50[DELETE /api/triase/{id}] --> API51[🗑️ Hapus]
    end

    subgraph API_PEMERIKSAAN["💉 API Pemeriksaan"]
        API60[GET /api/pemeriksaan] --> API61[📋 List]
        API60 --> API62[GET /api/pemeriksaan/by-user] --> API63[👤 By User]
        API60 --> API64[POST /api/pemeriksaan] --> API65[➕ Pemeriksaan Baru]
        API60 --> API66[GET /api/pemeriksaan/{id}] --> API67[👁️ Detail]
        API60 --> API66 --> API68[PUT /api/pemeriksaan/{id}] --> API69[✏️ Update]
        API60 --> API66 --> API70[DELETE /api/pemeriksaan/{id}] --> API71[🗑️ Hapus]
    end

    subgraph API_RUJUKAN["🔄 API Rujukan"]
        API80[GET /api/rujukan] --> API81[📋 List]
        API80 --> API82[GET /api/rujukan/by-user] --> API83[👤 By User]
        API80 --> API84[POST /api/rujukan] --> API85[➕ Rujuk]
        API80 --> API86[GET /api/rujukan/{id}] --> API87[👁️ Detail]
        API80 --> API86 --> API88[PUT /api/rujukan/{id}] --> API89[✏️ Update]
        API80 --> API86 --> API90[DELETE /api/rujukan/{id}] --> API91[🗑️ Hapus]
    end

    subgraph API_RS["🏨 API Rumah Sakit"]
        API100[GET /api/rumah-sakit] --> API101[📋 List RS]
        API100 --> API102[POST /api/rumah-sakit] --> API103[➕ Tambah RS]
        API100 --> API104[GET /api/rumah-sakit/{id}] --> API105[👁️ Detail]
        API100 --> API104 --> API106[PUT /api/rumah-sakit/{id}] --> API107[✏️ Update]
        API100 --> API104 --> API108[DELETE /api/rumah-sakit/{id}] --> API109[🗑️ Hapus]
        API100 --> API110[GET /api/rumah-sakit/nearby] --> API111[📍 Find Nearby]
    end
```

## 5. Diagram Relasi Entitas (Entity Relationship)

```mermaid
erDiagram
    USER ||--o{ BENCANA : "creates"
    USER ||--o{ KORBAN : "registers"
    USER ||--o{ TRIASE : "assesses"
    USER ||--o{ PEMERIKSAAN : "examines"
    USER ||--o{ RUJUKAN : "refers"
    
    BENCANA ||--o{ KORBAN : "has"
    
    KORBAN ||--o| TRIASE : "gets"
    KORBAN ||--o{ PEMERIKSAAN : "undergoes"
    KORBAN ||--o{ RUJUKAN : "receives"
    KORBAN ||--o| LOKASI_KORBAN : "located at"
    
    RUMAH_SAKIT ||--o{ RUJUKAN : "receives"
    
    USER {
        bigint id PK
        string name
        string username
        string email
        string password
        string role
        timestamp created_at
        timestamp updated_at
    }
    
    BENCANA {
        bigint id PK
        string nama_bencana
        string jenis_bencana
        string lokasi
        date tanggal_kejadian
        string status
        text keterangan
        timestamp created_at
        timestamp updated_at
    }
    
    KORBAN {
        bigint id PK
        bigint bencana_id FK
        bigint user_id FK
        string nama
        string jenis_kelamin
        int umur
        string status_identitas
        string lokasi_ditemukan
        date tanggal_ditemukan
        text kondisi_awal
        string foto
        timestamp created_at
        timestamp updated_at
    }
    
    TRIASE {
        bigint id PK
        bigint korban_id FK
        bigint user_id FK
        string kategori
        text keterangan
        timestamp created_at
        timestamp updated_at
    }
    
    PEMERIKSAAN {
        bigint id PK
        bigint korban_id FK
        bigint user_id FK
        json identitas_pasien
        json vital_sign
        json primary_survey
        text diagnosa_awal
        text tindakan
        text terapi
        timestamp created_at
        timestamp updated_at
    }
    
    RUJUKAN {
        bigint id PK
        bigint korban_id FK
        bigint rumah_sakit_id FK
        bigint user_id FK
        string status
        datetime waktu_rujuk
        text catatan
        timestamp created_at
        timestamp updated_at
    }
    
    RUMAH_SAKIT {
        bigint id PK
        string nama
        text alamat
        string no_hp
        decimal latitude
        decimal longitude
        int kapasitas_igd
        timestamp created_at
        timestamp updated_at
    }
    
    LOKASI_KORBAN {
        bigint id PK
        bigint korban_id FK
        decimal latitude
        decimal longitude
        timestamp created_at
        timestamp updated_at
    }
```

## 6. Flowchart Sistem Pelaporan (Reporting)

```mermaid
flowchart TB
    subgraph REPORT["📊 SISTEM PELAPORAN"]
        R1[📋 Menu Laporan] --> R2{Pilih Jenis?}
        R2 -->|🌊 Bencana| R3[Laporan Bencana]
        R2 -->|👥 Korban| R4[Laporan Korban]
        R2 -->|🏥 Triase| R5[Laporan Triase]
        R2 -->|💉 Pemeriksaan| R6[Laporan Pemeriksaan]
        R2 -->|🔄 Rujukan| R7[Laporan Rujukan]
        R2 -->|🏨 Rumah Sakit| R8[Laporan Rumah Sakit]
        
        R3 --> R9[🔍 Filter Data]
        R4 --> R9
        R5 --> R9
        R6 --> R9
        R7 --> R9
        R8 --> R9
        
        R9 --> R10{Tampilkan?}
        R10 -->|📄 Layar| R11[Tabel View]
        R10 -->|📅 Tanggal| R12[Filter Tanggal]
        R10 -->|🏷️ Kategori| R13[Filter Kategori]
        
        R11 --> R14[📤 Export Options]
        R12 --> R14
        R13 --> R14
        
        R14 --> R15{PDF?}
        R15 -->|Ya| R16[Generate PDF]
        R15 -->|Tidak| R17[Done]
        R16 --> R17
    end
```

## 7. Alur Multi-User Role

```mermaid
flowchart TB
    subgraph LOGIN["🔐 LOGIN"]
        L1[👤 Username/Password] --> L2{Cek Role}
        L2 -->|admin| L3[🛡️ Menu Admin]
        L2 -->|medis| L4[👨‍⚕️ Menu Medis]
        L2 -->|petugas| L5[🚓 Menu Petugas]
        L2 -->|relawan| L6[🤝 Menu Relawan]
    end

    subgraph ADMIN["🛡️ Hak Akses Admin"]
        A1[✅ CRUD User]
        A2[✅ CRUD Bencana]
        A3[✅ CRUD Rumah Sakit]
        A4[✅ View Semua Data]
        A5[✅ CRUD Triase]
        A6[✅ CRUD Pemeriksaan]
        A7[✅ CRUD Rujukan]
        A8[✅ CRUD Korban]
        A9[✅ Semua Laporan]
        A10[✅ API Documentation]
    end

    subgraph MEDIS["👨‍⚕️ Hak Akses Medis"]
        M1[❌ CRUD User]
        M2[❌ CRUD Bencana]
        M3[❌ CRUD Rumah Sakit]
        M4[✅ View Semua Data]
        M5[✅ CRUD Triase]
        M6[✅ CRUD Pemeriksaan]
        M7[✅ CRUD Rujukan]
        M8[❌ CRUD Korban]
        M9[✅ Laporan Sendiri]
        M10[❌ API Docs]
    end

    subgraph PETUGAS["🚓 Hak Akses Petugas"]
        P1[❌ CRUD User]
        P2[❌ CRUD Bencana]
        P3[❌ CRUD Rumah Sakit]
        P4[✅ View Data Terbatas]
        P5[❌ CRUD Triase]
        P6[❌ CRUD Pemeriksaan]
        P7[❌ CRUD Rujukan]
        P8[✅ CRUD Korban]
        P9[✅ Laporan Terbatas]
        P10[❌ API Docs]
    end

    subgraph RELAWAN["🤝 Hak Akses Relawan"]
        R1[❌ CRUD User]
        R2[❌ CRUD Bencana]
        R3[❌ CRUD Rumah Sakit]
        R4[✅ View Terbatas]
        R5[❌ CRUD Triase]
        R6[❌ CRUD Pemeriksaan]
        R7[❌ CRUD Rujukan]
        R8[✅ CRUD Korban]
        R9[❌ Laporan]
        R10[❌ API Docs]
    end

    L3 --> ADMIN
    L4 --> MEDIS
    L5 --> PETUGAS
    L6 --> RELAWAN
```

## 8. Sequence Diagram: Alur Penanganan Korban

```mermaid
sequenceDiagram
    participant Petugas
    participant Sistem
    participant Admin
    participant Database
    
    Petugas->>Sistem: Login ke Aplikasi
    Sistem->>Database: Validasi Kredensial
    Database-->>Sistem: User Terotentikasi
    Sistem-->>Petugas: Tampilkan Dashboard
    
    Note over Petugas,Sistem: Admin Membuat Bencana
    Admin->>Sistem: Buat Bencana Baru
    Sistem->>Database: INSERT Bencana
    Database-->>Sistem: Berhasil
    Sistem-->>Admin: Notifikasi Sukses
    
    Note over Petugas,Sistem: Petugas Mendaftarkan Korban
    Petugas->>Sistem: Pilih Bencana
    Petugas->>Sistem: Input Data Korban
    Sistem->>Database: INSERT Korban
    Database-->>Sistem: Berhasil
    Sistem-->>Petugas: Notifikasi Sukses
    
    Note over Admin,Sistem: Tim Medis Melakukan Triase
    Admin->>Sistem: Pilih Korban
    Admin->>Sistem: Assessment Triase
    Admin->>Sistem: Pilih Kategori (Merah/Kuning/Hijau/Hitam)
    Sistem->>Database: INSERT Triase
    Database-->>Sistem: Berhasil
    
    Note over Admin,Sistem: Pemeriksaan Medis
    Admin->>Sistem: Pilih Korban
    Admin->>Sistem: Input Vital Sign
    Admin->>Sistem: Input Primary Survey
    Admin->>Sistem: Input Diagnosis & Tindakan
    Sistem->>Database: INSERT Pemeriksaan
    Database-->>Sistem: Berhasil
    
    alt Korban perlu dirujuk
        Note over Admin,Sistem: Rujukan ke Rumah Sakit
        Admin->>Sistem: Pilih Korban
        Admin->>Sistem: Pilih Rumah Sakit Tujuan
        Admin->>Sistem: Input Catatan Rujukan
        Sistem->>Database: INSERT Rujukan
        Database-->>Sistem: Berhasil
        Sistem-->>Admin: Notifikasi Rujukan Berhasil
    end
    
    Note over Admin,Sistem: Pembuatan Laporan
    Admin->>Sistem: Pilih Menu Laporan
    Admin->>Sistem: Pilih Jenis Laporan
    Admin->>Sistem: Set Filter Tanggal
    Sistem->>Database: Query Data
    Database-->>Sistem: Data Laporan
    Sistem-->>Admin: Tampilkan Laporan
    Admin->>Sistem: Export PDF
    Sistem-->>Admin: Download PDF
```

## 9. Alur Error Handling

```mermaid
flowchart TB
    E1[🔄 Request] --> E2{Validasi}
    E2 -->|Gagal| E3[❌ Error 422<br/>Validation Failed]
    E2 -->|Berhasil| E4{Cek Hak Akses}
    E4 -->|Gagal| E5[❌ Error 403<br/>Forbidden]
    E4 -->|Berhasil| E6{Cek Resource}
    E6 -->|Tidak Ada| E7[❌ Error 404<br/>Not Found]
    E6 -->|Ada| E8{Operasi DB}
    E8 -->|Gagal| E9[❌ Error 500<br/>Server Error]
    E8 -->|Berhasil| E10[✅ Response 200/201]
    
    E3 --> E11[📝 Tampilkan Pesan Error]
    E5 --> E11
    E7 --> E11
    E9 --> E11
    
    E11 --> E12{Retry?}
    E12 -->|Ya| E1
    E12 -->|Tidak| E13[🔙 Kembali]
```

## 10. Legenda

| Simbol | Keterangan |
|--------|------------|
| 🔐 | Autentikasi/Keamanan |
| 📋 | List/Index Data |
| ➕ | Create/Tambah Data |
| ✏️ | Edit/Update Data |
| 🗑️ | Delete/Hapus Data |
| 👁️ | Show/Detail Data |
| 💾 | Simpan ke Database |
| ❌ | Error/Gagal |
| ✅ | Berhasil |
| 🔄 | Refresh/Loop |
| 📤 | Export/Output |
| 📥 | Import/Input |

---

## Struktur Menu Admin

```
🏠 Dashboard
├── 📊 Statistik Keseluruhan
├── 📈 Recent Bencana
└── 🔗 Quick Actions

📋 Bencana
├── 📋 Daftar Bencana
├── ➕ Tambah Bencana
├── ✏️ Edit Bencana
├── 👁️ Detail Bencana
└── 🗑️ Hapus Bencana

👥 Korban
├── 📋 Daftar Korban
├── ➕ Tambah Korban
├── ✏️ Edit Korban
├── 👁️ Detail Korban
└── 🗑️ Hapus Korban

🏥 Triase
├── 📋 Daftar Triase
├── ➕ Assessment Triase
├── ✏️ Edit Triase
├── 👁️ Detail Triase
└── 🗑️ Hapus Triase

💉 Pemeriksaan
├── 📋 Daftar Pemeriksaan
├── ➕ Tambah Pemeriksaan
├── ✏️ Edit Pemeriksaan
├── 👁️ Detail Pemeriksaan
└── 🗑️ Hapus Pemeriksaan

🔄 Rujukan
├── 📋 Daftar Rujukan
├── ➕ Tambah Rujukan
├── ✏️ Edit Rujukan
├── 👁️ Detail Rujukan
└── 🗑️ Hapus Rujukan

🏨 Rumah Sakit
├── 📋 Daftar Rumah Sakit
├── ➕ Tambah Rumah Sakit
├── ✏️ Edit Rumah Sakit
├── 👁️ Detail Rumah Sakit
└── 🗑️ Hapus Rumah Sakit

👤 User Management
├── 📋 Daftar User
├── ➕ Tambah User
├── ✏️ Edit User
├── 👁️ Detail User
└── 🗑️ Hapus User

📄 Laporan
├── 📊 Laporan Bencana
├── 📊 Laporan Korban
├── 📊 Laporan Triase
├── 📊 Laporan Pemeriksaan
├── 📊 Laporan Rujukan
└── 📊 Laporan Rumah Sakit

📚 API Documentation
└── 📖 Panduan API
```

---

**Catatan:** Flowchart ini dibuat berdasarkan analisis kode aplikasi AppBencana yang merupakan sistem manajemen bencana berbasis web dan mobile API menggunakan Laravel framework.
