(function () {
    "use strict";

    /**
     * Easy selector helper function
     */

    /**
     * Preloader
     */
    const preloader = document.querySelector("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }

    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach((e) => e.addEventListener(type, listener));
        } else {
            select(el, all).addEventListener(type, listener);
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Sidebar toggle
     */
    if (select(".toggle-sidebar-btn")) {
        on("click", ".toggle-sidebar-btn", function (e) {
            select("body").classList.toggle("toggle-sidebar");
        });
    }

    /**
     * Search bar toggle
     */
    if (select(".search-bar-toggle")) {
        on("click", ".search-bar-toggle", function (e) {
            select(".search-bar").classList.toggle("search-bar-show");
        });
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select("#navbar .scrollto", true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach((navbarlink) => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select("#header");
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add("header-scrolled");
            } else {
                selectHeader.classList.remove("header-scrolled");
            }
        };
        window.addEventListener("load", headerScrolled);
        onscroll(document, headerScrolled);
    }

    /**
     * Back to top button
     */
    let backtotop = select(".back-to-top");
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add("active");
            } else {
                backtotop.classList.remove("active");
            }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /**
     * Initiate quill editors
     */
    if (select(".quill-editor-default")) {
        new Quill(".quill-editor-default", {
            theme: "snow",
        });
    }

    if (select(".quill-editor-bubble")) {
        new Quill(".quill-editor-bubble", {
            theme: "bubble",
        });
    }

    if (select(".quill-editor-full")) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [
                        {
                            font: [],
                        },
                        {
                            size: [],
                        },
                    ],
                    ["bold", "italic", "underline", "strike"],
                    [
                        {
                            color: [],
                        },
                        {
                            background: [],
                        },
                    ],
                    [
                        {
                            script: "super",
                        },
                        {
                            script: "sub",
                        },
                    ],
                    [
                        {
                            list: "ordered",
                        },
                        {
                            list: "bullet",
                        },
                        {
                            indent: "-1",
                        },
                        {
                            indent: "+1",
                        },
                    ],
                    [
                        "direction",
                        {
                            align: [],
                        },
                    ],
                    ["link", "image", "video"],
                    ["clean"],
                ],
            },
            theme: "snow",
        });
    }

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call(needsValidation).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });

    /**
     * Autoresize echart charts
     */
    const mainContainer = select("#main");
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function () {
                select(".echart", true).forEach((getEchart) => {
                    echarts.getInstanceByDom(getEchart).resize();
                });
            }).observe(mainContainer);
        }, 200);
    }
})();

// image preview
function previewImage() {
    const image = document.querySelector("#image");
    const imgPreview = document.querySelector(".img-preview");

    imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}

// sweetalert2

// konfirmasi hapus data
function confirmDelete(id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
}

// Cek apakah ada session sukses
document.addEventListener("DOMContentLoaded", function () {
    if (window.sessionStorage.getItem("successMessage")) {
        Swal.fire({
            icon: "success",
            title: "Sukses",
            text: window.sessionStorage.getItem("successMessage"),
            showConfirmButton: false,
            timer: 2000,
        });
        window.sessionStorage.removeItem("successMessage");
    }
});

// Cek apakah ada error
document.addEventListener("DOMContentLoaded", function () {
    if (window.sessionStorage.getItem("errorMessage")) {
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: window.sessionStorage.getItem("errorMessage"),
            showConfirmButton: false,
            timer: 3000,
        });
        window.sessionStorage.removeItem("errorMessage");
    }
});

// Konfigurasi data tabel, delete data tunggal, delete banyak data, tampilkan tombol button, sweet alert
$(document).ready(function () {
    $(document).ready(function () {
        // Fungsi untuk memeriksa apakah ada data yang dipilih dan menampilkan atau menyembunyikan tombol "Hapus Terpilih"
        function checkSelectedData() {
            var isChecked = $(".bulk-checkbox:checked").length > 0;
            $("#bulk-delete-form").toggle(isChecked);
        }

        // Fungsi untuk memeriksa status checkbox header berdasarkan checkbox kolom
        function checkHeaderCheckbox() {
            var allChecked =
                $(".bulk-checkbox").length ===
                $(".bulk-checkbox:checked").length;
            var anyChecked = $(".bulk-checkbox:checked").length > 0;
            $("#select-all").prop("checked", allChecked || anyChecked);
        }

        // Ketika kotak centang di header tabel dicentang atau tidak dicentang
        $("#select-all").click(function () {
            // Atur status centang semua kotak centang di kolom pada tabel sesuai dengan status kotak centang di header
            $(".bulk-checkbox").prop("checked", $(this).prop("checked"));
            // Periksa apakah ada data yang dipilih dan tampilkan atau sembunyikan tombol "Hapus Terpilih"
            checkSelectedData();
        });

        // Ketika salah satu kotak centang di kolom diubah statusnya
        $(document).on("click", ".bulk-checkbox", function () {
            // Periksa status checkbox header
            checkHeaderCheckbox();
            // Periksa apakah ada data yang dipilih dan tampilkan atau sembunyikan tombol "Hapus Terpilih"
            checkSelectedData();
        });

        // Dapatkan URL dari atribut data
        var bulkDeleteUrl = $("#bulk-delete-form").data("url");

        // Pengaturan untuk menghapus item terpilih
        $("#delete-selected").click(function (event) {
            event.preventDefault(); // Menghentikan aksi default tombol hapus

            var selectedItems = $(".bulk-checkbox:checked")
                .map(function () {
                    return $(this).val();
                })
                .get();

            if (selectedItems.length > 0) {
                Swal.fire({
                    title: "Konfirmasi",
                    text:
                        "Apakah Anda yakin ingin menghapus " +
                        selectedItems.length +
                        " item terpilih?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: bulkDeleteUrl,
                            type: "POST", // Menggunakan metode POST
                            data: {
                                ids: selectedItems,
                                _token: $('meta[name="csrf-token"]').attr(
                                    "content"
                                ),
                            },
                            success: function (response) {
                                if (response.success) {
                                    window.LaravelDataTables[
                                        "data-table"
                                    ].draw();
                                    Swal.fire({
                                        title: "Sukses!",
                                        text: response.message,
                                        icon: response.icon,
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                                    // Setelah data berhasil dihapus, sembunyikan tombol "Hapus Terpilih"
                                    $("#bulk-delete-form").hide();
                                    // Hilangkan centang di checkbox header
                                    $("#select-all").prop("checked", false);
                                } else {
                                    Swal.fire(
                                        "Error!",
                                        "Terjadi kesalahan saat menghapus data: " +
                                            response.error,
                                        "error"
                                    );
                                }
                            },
                        });
                    }
                });
            } else {
                Swal.fire(
                    "Peringatan!",
                    "Tidak ada item yang dipilih untuk dihapus.",
                    "warning"
                );
            }
        });
    });
});

// summernote
$(document).ready(function () {
    $("#summernote").summernote({
        height: 300,
        placeholder: "Masukan Deskripsi Di Sini",
        lang: "id-ID", // Bahasa Indonesia, bisa disesuaikan
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["history", ["undo", "redo"]], // Menambahkan undo dan redo
        ],
    });
});