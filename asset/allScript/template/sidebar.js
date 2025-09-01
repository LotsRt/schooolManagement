
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const content = document.getElementById('main-content');
      const navbar = document.getElementById('navbar');

      sidebar.classList.toggle('collapsed');
      content.classList.toggle('collapsed');

      if (sidebar.classList.contains('collapsed')) {
        navbar.classList.remove('expanded');
        navbar.classList.add('collapsed');
      } else {
        navbar.classList.remove('collapsed');
        navbar.classList.add('expanded');
      }

      // Cacher ou afficher le texte des liens
      document.querySelectorAll('.link-text').forEach(el => {
        el.style.display = sidebar.classList.contains('collapsed') ? 'none' : 'inline';
      });
    }

    // Initial collapse state if needed
    toggleSidebar(); // D�commente cette ligne pour d�marrer avec le sidebar repli�