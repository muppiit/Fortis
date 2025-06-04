<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Attendance</title>

    <!-- ======================  COLOR PALETTE  ===================== -->
    <style>
        :root {
            /*  BRAND  */
            --primary: #2563eb;          /* blue-600  */
            --primary-light: #dbeafe;   /* blue-100  */
            --primary-hover: #1d4ed8;   /* blue-700  */
            /*  NEUTRALS  */
            --background: #f8fafc;      /* slighter white */
            --card: #ffffff;
            --border: #e2e8f0;          /* slate-200 */
            --text: #1e293b;            /* slate-800 */
            --text-muted: #64748b;      /* slate-500 */
            /*  STATE  */
            --success: #10b981;
            --warning: #f59e0b;
            --danger:  #ef4444;
            --radius:  0.75rem;
            --shadow:  0 4px 12px rgba(0,0,0,.05);
        }

        /* ======================  RESET  ============================ */
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:var(--background);color:var(--text);line-height:1.5;padding:2rem;}
        img,svg{display:block;height:auto;max-width:100%;}

        /* ======================  HELPERS  ========================== */
        .sr{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;}/* screen‑reader only */

        /* ======================  LAYOUT  =========================== */
        .container{max-width:1280px;margin-inline:auto;}

        .card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;margin-block-end:2rem;}
        .card-header,.pagination{display:flex;gap:1rem;flex-wrap:wrap;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-block-end:1px solid var(--border);}        

        /* ======================  TYPOGRAPHY  ======================= */
        h1{font-size:1.5rem;font-weight:700;color:var(--text);margin-block-end:1rem;}

        /* ======================  FORMS  ============================ */
        .field{display:flex;flex-direction:column;gap:.25rem;}
        .field input[type="time"],
        .select,
        .search-input{appearance:none;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:.5rem .75rem;font-size:.875rem;transition:border-color .2s,box-shadow .2s;min-width:180px;}
        .search-input{padding-left:2.25rem;}
        .select:hover,.select:focus,
        .search-input:hover,.search-input:focus,
        input[type="time"]:hover,input[type="time"]:focus{border-color:var(--primary);box-shadow:0 0 0 3px var(--primary-light);}        
        .select{cursor:pointer;}

        /* ======================  BUTTONS  ========================== */
        .btn{display:inline-flex;align-items:center;gap:.5rem;padding:.5rem 1rem;font-size:.875rem;font-weight:500;border-radius:var(--radius);border:1px solid transparent;cursor:pointer;transition:background-color .2s,box-shadow .2s,transform .15s;}
        .btn svg{stroke-width:2;}
        .btn-primary{background:var(--primary);color:#fff;}
        .btn-primary:hover{background:var(--primary-hover);}        
        .btn-outline{background:#fff;border-color:var(--border);color:var(--text);}        
        .btn-outline:hover{background:var(--primary-light);}
        .btn:active{transform:scale(.97);}        

        /* ======================  TABLE  ============================ */
        .table-wrapper{overflow:auto;max-width:100%;}
        table{width:100%;border-collapse:collapse;font-size:.875rem;min-width:900px;}
        thead{background:var(--primary-light);}
        th,td{padding:.75rem 1rem;text-align:left;white-space:nowrap;border-bottom:1px solid var(--border);}        
        th{font-weight:600;color:var(--text);user-select:none;position:relative;cursor:pointer;}
        th[data-sort="asc"]::after,th[data-sort="desc"]::after{content:"";border:6px solid transparent;border-top-color:var(--text-muted);position:absolute;right:.5rem;top:50%;transform:translateY(-50%) rotate(0deg);opacity:.7;}
        th[data-sort="desc"]::after{transform:translateY(-50%) rotate(180deg);}        
        tr:hover td{background:var(--primary-light);}        
        .badge{display:inline-block;padding:.25rem .5rem;border-radius:.5rem;font-size:.75rem;font-weight:600;text-transform:capitalize;}
        .badge-in{background:rgba(16,185,129,.15);color:var(--success);}        
        .badge-out{background:rgba(239,68,68,.15);color:var(--danger);}        
        .badge-break{background:rgba(245,158,11,.15);color:var(--warning);}        

        /* ======================  PAGINATION  ======================= */
        .pagination-info{font-size:.875rem;color:var(--text-muted);}
        .pager{display:flex;gap:.5rem;}
        .pager-btn{display:inline-flex;align-items:center;justify-content:center;width:2.25rem;height:2.25rem;border:1px solid var(--border);border-radius:var(--radius);background:#fff;font-size:.875rem;cursor:pointer;transition:background-color .2s,transform .15s;}
        .pager-btn.active{background:var(--primary);border-color:var(--primary);color:#fff;}
        .pager-btn:hover:not(:disabled){background:var(--primary-light);}        
        .pager-btn:disabled{opacity:.45;cursor:not-allowed;}
        .pager-btn:active:not(:disabled){transform:scale(.93);}        

        /* ======================  EMPTY STATE  ===================== */
        .empty{padding:4rem 0;text-align:center;color:var(--text-muted);}        
        .empty svg{margin-inline:auto;margin-block-end:1rem;stroke:var(--text-muted);}        

        @media(max-width:768px){
            .card-header{flex-direction:column;align-items:flex-start;}
            .search-input{width:100%;}
        }
    </style>

    <!-- ======================  ICONS  ============================ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <!--===============  MANAGE WORKING HOURS (OPTIONAL)  ===============-->
    @if (auth()->user()->role->level === 'super_super_admin')
        <div class="card">
            <div class="card-header">
                <h2 class="text-lg font-semibold">Atur Jam Masuk &amp; Pulang</h2>
            </div>
            <div style="padding:1.5rem;display:flex;flex-direction:column;gap:1rem;">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.attendance.update-working-hours') }}" method="POST" style="display:flex;flex-wrap:wrap;gap:1rem;align-items:flex-end;">
                    @csrf
                    <div class="field">
                        <label for="clock_in_time">Jam Masuk</label>
                        <input type="time" id="clock_in_time" name="clock_in_time" value="{{ old('clock_in_time', $workingHour->clock_in_time ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="clock_out_time">Jam Pulang</label>
                        <input type="time" id="clock_out_time" name="clock_out_time" value="{{ old('clock_out_time', $workingHour->clock_out_time ?? '') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    @endif

    <!--===============  TABLE CARD  ===============-->
    <div class="card">
        <!--  Header  -->
        <div class="card-header">
            <!-- Search -->
            <div style="position:relative;flex:1;max-width:300px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);stroke:var(--text-muted);">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Cari nama / NIP…" id="searchInput" oninput="filterTable()">
            </div>
            <!-- Filters -->
            <select id="typeFilter" class="select" onchange="filterTable()">
                <option value="">Semua Tipe</option>
                <option value="clock-in">clock-in</option>
                <option value="clock-out">clock-out</option>
            </select>
        </div>
        <!--  Table  -->
        <div class="table-wrapper">
            <table id="attendanceTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">NIP</th>
                        <th onclick="sortTable(1)">Nama</th>
                        <th onclick="sortTable(2)">Departemen</th>
                        <th onclick="sortTable(3)">Team Departemen</th>
                        <th onclick="sortTable(4)">Manajer</th>
                        <th onclick="sortTable(5)">Tipe</th>
                        <th onclick="sortTable(6)">Waktu</th>
                        <th onclick="sortTable(7)">Telat</th>
                        <th onclick="sortTable(8)">Lembur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $a)
                        <tr>
                            <td>{{ $a->user->nip }}</td>
                            <td>{{ $a->user->name }}</td>
                            <td>{{ $a->user->teamDepartment->department->department ?? '-' }}</td>
                            <td>{{ $a->user->teamDepartment->name ?? '-' }}</td>
                            <td>{{ $a->user->teamDepartment->department->manager_department ?? '-' }}</td>
                            <td>
                                @if ($a->type == 'clock-in')
                                    <span class="badge badge-in">clock-in</span>
                                @elseif($a->type == 'clock-out')
                                    <span class="badge badge-out">clock-out</span>
                                @else
                                    <span class="badge badge-break">{{ $a->type }}</span>
                                @endif
                            </td>
                            <td>{{ $a->waktu->format('d M Y, H:i') }}</td>
                            <td>
                                @if ($a->late_duration !== null)
                                    {{ rtrim(rtrim(number_format($a->late_duration, 2), '0'), '.') }} jam
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($a->overtime_duration !== null)
                                    {{ rtrim(rtrim(number_format($a->overtime_duration, 2), '0'), '.') }} jam
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--  Pagination  -->
        <div class="pagination">
            <div class="pagination-info">Menampilkan <span id="startRecord">1</span>–<span id="endRecord">10</span> dari <span id="totalRecords">0</span> data</div>
            <div class="pager">
                <button class="pager-btn" id="prevPage" disabled aria-label="Sebelumnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button class="pager-btn active">1</button>
                <button class="pager-btn">2</button>
                <button class="pager-btn">3</button>
                <button class="pager-btn" id="nextPage" aria-label="Berikutnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!--===============  BACK TO DASHBOARD  ===============-->
    <a href="{{ route('admin.dashboard') }}" style="text-decoration:none;">
        <button type="button" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Dashboard
        </button>
    </a>
</div>

<!-- ======================  INTERACTIVITY  ========================= -->
<script>
    // =========  FILTER & SEARCH  =========
    function filterTable(){
        const searchVal = document.getElementById('searchInput').value.toLowerCase();
        const typeVal   = document.getElementById('typeFilter').value;
        const rows      = document.querySelectorAll('#attendanceTable tbody tr');
        let visible = 0;
        rows.forEach(row=>{
            const nip        = row.cells[0].textContent.toLowerCase();
            const name       = row.cells[1].textContent.toLowerCase();
            const typeBadge  = row.cells[5].querySelector('.badge');
            const type       = typeBadge ? typeBadge.textContent.toLowerCase() : '';
            const matchSearch = nip.includes(searchVal)||name.includes(searchVal);
            const matchType   = !typeVal || type.includes(typeVal);
            if(matchSearch && matchType){row.style.display='';visible++;}
            else{row.style.display='none';}
        });
        updatePaginationInfo(visible);
        toggleEmptyState(visible);
    }

    // =========  SORTING  =========
    function sortTable(index){
        const table = document.getElementById('attendanceTable');
        const tbody = table.tBodies[0];
        const rows  = Array.from(tbody.rows);
        const th    = table.tHead.rows[0].cells[index];
        const dir   = th.getAttribute('data-sort')==='asc'?'desc':'asc';
        [...table.tHead.rows[0].cells].forEach(h=>h.removeAttribute('data-sort'));
        th.setAttribute('data-sort',dir);
        rows.sort((a,b)=>{
            let aVal=a.cells[index].textContent.trim();
            let bVal=b.cells[index].textContent.trim();
            if(index===6){aVal=new Date(aVal);bVal=new Date(bVal);} // date column
            return dir==='asc' ? (aVal>bVal?1:-1) : (aVal<bVal?1:-1);
        }).forEach(r=>tbody.appendChild(r));
    }

    // =========  EMPTY STATE  =========
    function toggleEmptyState(count){
        const tbody = document.querySelector('#attendanceTable tbody');
        let emptyRow = document.getElementById('emptyState');
        if(count===0){
            if(!emptyRow){
                emptyRow=document.createElement('tr');
                emptyRow.id='emptyState';
                emptyRow.innerHTML=`<td colspan="9" class="empty">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <p>Data tidak ditemukan</p>
                </td>`;
                tbody.appendChild(emptyRow);
            }
        }else{if(emptyRow) emptyRow.remove();}
    }

    // =========  PAGINATION INFO  =========
    function updatePaginationInfo(total){
        document.getElementById('totalRecords').textContent=total;
        const start=total?1:0;
        const end=Math.min(10,total);
        document.getElementById('startRecord').textContent=start;
        document.getElementById('endRecord').textContent=end;
    }

    // Initial count on load
    document.addEventListener('DOMContentLoaded',()=>{
        const totalRows=document.querySelectorAll('#attendanceTable tbody tr').length;
        updatePaginationInfo(totalRows);
    });
</script>
</body>
</html>
