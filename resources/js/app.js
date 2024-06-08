// import './bootstrap';

$(document).ready(function () {
    $('.togglePassword').click(function () {
        const type = $(this).siblings().attr('type') === 'password' ? 'text' : 'password';
        $(this).siblings().attr('type', type);

        if (type === 'password') {
            // $(this).children().attr('src', "{{ asset('assets/icons/actionable/eye.svg') }}");
            $(this).children().remove();
            $(this).append(`<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.227 12C16.227 13.98 14.627 15.58 12.647 15.58C10.667 15.58 9.06703 13.98 9.06703 12C9.06703 10.02 10.667 8.42 12.647 8.42C14.627 8.42 16.227 10.02 16.227 12Z"
                stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M12.647 20.27C16.177 20.27 19.467 18.19 21.757 14.59C22.657 13.18 22.657 10.81 21.757 9.4C19.467 5.8 16.177 3.72 12.647 3.72C9.11703 3.72 5.82703 5.8 3.53703 9.4C2.63703 10.81 2.63703 13.18 3.53703 14.59C5.82703 18.19 9.11703 20.27 12.647 20.27Z"
                stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        </svg>`);
        } else {
            $(this).children().remove();
            $(this).append(`<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
            d="M15.177 9.47L10.117 14.53C9.46703 13.88 9.06703 12.99 9.06703 12C9.06703 10.02 10.667 8.42 12.647 8.42C13.637 8.42 14.527 8.82 15.177 9.47Z"
            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M18.467 5.77C16.717 4.45 14.717 3.73 12.647 3.73C9.11703 3.73 5.82703 5.81 3.53703 9.41C2.63703 10.82 2.63703 13.19 3.53703 14.6C4.32703 15.84 5.24703 16.91 6.24703 17.77"
            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M9.06703 19.53C10.207 20.01 11.417 20.27 12.647 20.27C16.177 20.27 19.467 18.19 21.757 14.59C22.657 13.18 22.657 10.81 21.757 9.4C21.427 8.88 21.067 8.39 20.697 7.93"
            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M16.157 12.7C15.897 14.11 14.747 15.26 13.337 15.52" stroke-width="1.5"
            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10.117 14.53L2.64703 22" stroke-width="1.5" stroke-miterlimit="10"
            stroke-linecap="round" stroke-linejoin="round" />
        <path d="M22.647 2L15.177 9.47" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>`);
            // $(this).children().attr('src', "{{ asset('assets/icons/actionable/eye-slash.svg') }}");
        }

    });

    console.log('halo');

    $('#closeFlash').click(function (e) {
        $(this).parent().remove();
    });

    $(document).on("click", ".dropdownItem", function () {
        let selected = $(this).text();
        let button = $(this).parents().parents().parents().children().children().first();
        // let dropItem = $(this);
        // console.log(dropItem);
        let name = $(button).parents().attr('name');
        let input = $(button).parents().parents().find('input[id=' + name + ']');
        $(button).text(selected);
        $(input).val(selected).trigger('change');
        // console.log($(button).parents().next().next().hasClass('tw-hidden'));
        // if (!($(dropItem).hasClass('tw-bg-b300'))) {
        //     $(dropItem).addClass('tw-bg-b300');
        // }
        // if (!($('.dropContent').hasClass('tw-hidden'))) {
        //     $('.dropContent').addClass('tw-hidden');
        // }
    });

    function getDropContent() {
        // var dropContents = [];
        $('.dropContent').each(function () {
            console.log($(this));
            console.log(!$(this).hasClass('tw-hidden'));
            if (!$(this).hasClass('tw-hidden')) {
                $(this).addClass('tw-hidden');
                // console.log(this);
            }
            // $(this).addClass('tw-hidden');
        });
    }


    $(document).on("click", ".dropdownTrigger", function () {
        if ($(this).siblings().next().hasClass('tw-hidden')) {
            // rotateArrow($(this).children().last())
            // $('.dropdownTrigger').siblings().addClass('tw-hidden');
            console.log(`if` + $('.dropdownTrigger').siblings().html());
            // rotateArrow($('.dropdownTrigger').children().last())
            $(this).siblings().next().removeClass('tw-hidden');
            let dropItems = $(this).siblings().children().last();
            $(dropItems).children().remove();
            let items = getDropdownItems($(this).attr('id'));
            let content = ``;

            $.each(items, function (indexInArray, item) {
                content += `<li class="dropdownItem tw-flex tw-items-center tw-h-10 hover:tw-bg-n300 tw-p-2 tw-placeholder">${item}</li>`;
            });
            console.log(items);
            if (items.length == 0 || items == undefined) {
                content += `<li class="">Tidak Ada Data</li>`
            }
            $(dropItems).append(content);
            $(this).siblings().children().focus();
        } else {
            // console.log($(this).siblings().find('.dropContent'));
            $(this).next().next().addClass('tw-hidden');

            // rotateArrow($(this).children().last())
        }
    });

    function rotateArrow(element) {
        $(element).hasClass('tw-rotate-180') ? $(element).removeClass('tw-rotate-180') : $(element).addClass('tw-rotate-180');;
    }

    function getDropdownItems(id) {
        if (id == 'jenis_pekerjaan-list') {
            let jenisPekerjaan = ["Belum/Tidak Bekerja", "Mengurus Rumah Tangga", "Pelajar/Mahasiswa", "Pensiunan", "Pegawai Negeri Sipil", "Tentara Nasional Indonesia", "Kepolisian RI", "Perdagangan", "Petani/Pekebun", "Peternak", "Nelayan/Perikanan", "Industri", "Konstruksi", "Transportasi", "Karyawan Swasta", "Karyawan BUMN", "Karyawan BUMD", "Karyawan Honorer", "Buruh Harian Lepas", "Buruh Tani/Perkebunan", "Buruh Nelayan/Perikanan", "Buruh Peternakan", "Pembantu Rumah Tangga", "Tukang Cukur", "Tukang Listrik", "Tukang Batu", "Tukang Kayu", "Tukang Sol Sepatu", "Tukang Las/Pandai Besi", "Tukang Jahit", "Penata Rambut", "Penata Rias", "Penata Busana", "Mekanik", "Tukang Gigi", "Seniman", "Tabib", "Paraji", "Perancang Busana", "Penerjemah", "Imam Masjid", "Pendeta", "Pastur", "Wartawan", "Ustadz/Mubaligh", "Juru Masak", "Promotor Acara", "Anggota DPR-RI", "Anggota DPD", "Anggota BPK", "Presiden", "Wakil Presiden", "Anggota Mahkamah Konstitusi", "Anggota Kabinet/Kementerian", "Duta Besar", "Gubernur", "Wakil Gubernur", "Bupati", "Wakil Bupati", "Walikota", "Wakil Walikota", "Anggota DPRD Provinsi", "Anggota DPRD Kabupaten", "Dosen", "Guru", "Pilot", "Pengacara", "Notaris", "Arsitek", "Akuntan", "Konsultan", "Dokter", "Bidan", "Perawat", "Apoteker", "Psikiater/Psikolog", "Penyiar Televisi", "Penyiar Radio", "Pelaut", "Peneliti", "Sopir", "Pialang", "Paranormal", "Pedagang", "Perangkat Desa", "Kepala Desa", "Biarawati", "Wiraswasta", "Anggota Lembaga Tinggi", "Artis", "Atlit", "Chef", "Manajer", "Tenaga Tata Usaha", "Operator", "Pekerja Pengolahan, Kerajinan", "Teknisi", "Asisten Ahli", "Lainnya"];
            return jenisPekerjaan.sort();
        } else if (id == 'status_perkawinan-list') {
            return ["Kawin", "Belum Kawin", "Cerai", "Cerai Hidup"]
        } else if (id == 'NIK-list') {
            return getWarga();
        } else if (id == 'jenis_data-list') {
            return ['Data Baru', 'Data Lama'];
        } else if (id == 'jenis_kelamin-list') {
            return ['Laki-laki', 'Perempuan'];
        } else if (id == 'agama-list') {
            let agama = ['Buddha', 'Hindu', 'Islam', 'Katolik', 'Kristen', 'Konghuchu'];
            return agama.sort();
        } else if (id == 'kewarganegaraan-list') {
            return ['WNI', 'WNA'];
        } else if (id == 'kategori-list') {
            return ['Artikel', 'Pengumuman'];
        } else if (id == 'status_publikasi-list') {
            return ['Ditampilkan', 'Disembunyikan'];
        } else if (id == 'status_keluarga-list') {
            return ["Kepala Keluarga", "Suami", "Istri", "Anak", "Menantu", "Cucu", "Orang Tua", "Mertua", "Famili Lain", "Pembantu", "Lainnya"];
        } else if (id == 'jenis_demografi-list' || id == 'jenis_demografi_keluar-list') {
            return getJenisDemografi();
        } else if (id == 'pendidikan-list') {
            return ['Tidak/Belum Sekolah', 'Belum Tamat SD/Sederajat', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 'Strata II'];
        } else if (id == 'no_kk-list') {
            return getKeluarga();
        } else if (id == 'jenis_bansos-list') {
            return getJenisBansos();
        } else if (id == 'scope_data-list') {
            return ['Semua', 'RT 001', 'RT 002', 'RT 003', 'RT 004', 'RT 005', 'RT 006', 'RT 007', 'RT 008', 'RT 009', 'RT 010', 'RT 011'];;
        }
    }
    $(document).on("keyup", "input[name=searchDropItem]", function (e) {
        // console.log($(this).val());
        let id = $(this).parent().parent().parent().children().next().attr('id');
        let parent = $(this).parents().parents();
        let dropdownItems = $(parent).find('ul');
        let arr = [];
        let filter = $(this).val();
        let items = getDropdownItems(id);
        arr = $.grep(items, function (item) {
            return item.toLowerCase().includes(filter.toLowerCase());
        }).map(item => `<li class="dropdownItem tw-flex tw-items-center tw-h-10 hover:tw-bg-n300 tw-p-2 tw-placeholder">${item}</li>`).join("");

        if (arr) {
            $(dropdownItems).children().remove();
            $(dropdownItems).append(arr);
        } else {
            $(dropdownItems).children().remove();
            $(dropdownItems).append(`<p>Data Tidak Ada</p>`);
        }
    });


    $(document).on("click", "button#filter", function () {
        if ($(this).siblings().hasClass('tw-hidden')) {
            $(this).siblings().removeClass('tw-hidden')
        } else {
            $(this).siblings().addClass('tw-hidden')
        }
    });

    $(document).on("click", "button.filterItem", function () {
        if ($(this).hasClass('tw-filter-default')) {
            $(this).removeClass('tw-filter-default');
            $(this).addClass('tw-filter-active');
        } else if ($(this).hasClass('tw-filter-active')) {
            $(this).removeClass('tw-filter-active');
            $(this).addClass('tw-filter-default');
        }
    });


    // console.log($('#jenis_perkawinan').val());

});