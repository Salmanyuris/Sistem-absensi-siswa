document.addEventListener("DOMContentLoaded", function () {
    var sidebar = document.getElementById("primary-sidebar");
    var menuToggle = document.querySelector(".menu-toggle");
    var backdrop = document.querySelector(".sidebar-backdrop");

    if (!sidebar || !menuToggle || !backdrop) {
        return;
    }

    function closeSidebar(restoreFocus) {
        sidebar.classList.remove("is-open");
        backdrop.hidden = true;
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.setAttribute("aria-label", "Buka menu navigasi");
        document.body.classList.remove("sidebar-open");

        if (restoreFocus) {
            menuToggle.focus();
        }
    }

    function openSidebar() {
        sidebar.classList.add("is-open");
        backdrop.hidden = false;
        menuToggle.setAttribute("aria-expanded", "true");
        menuToggle.setAttribute("aria-label", "Tutup menu navigasi");
        document.body.classList.add("sidebar-open");

        var firstLink = sidebar.querySelector(".side-nav a");
        if (firstLink) {
            firstLink.focus();
        }
    }

    menuToggle.addEventListener("click", function () {
        if (sidebar.classList.contains("is-open")) {
            closeSidebar(true);
        } else {
            openSidebar();
        }
    });

    backdrop.addEventListener("click", function () {
        closeSidebar(true);
    });

    sidebar.addEventListener("click", function (event) {
        if (event.target.closest("a[href]")) {
            closeSidebar(false);
        }
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape" && sidebar.classList.contains("is-open")) {
            closeSidebar(true);
        }
    });

    window.addEventListener("resize", function () {
        if (window.innerWidth > 820 && sidebar.classList.contains("is-open")) {
            closeSidebar(false);
        }
    });
});
