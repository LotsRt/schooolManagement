<body>

  <!-- Sidebar -->
  <div class="sidebar position-fixed d-flex flex-column p-3" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()" title="R�duire le menu">
      <i class="fas fa-bars"></i>
    </button>
    <ul class="nav flex-column">

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Accueil') ?>"><i class="fas fa-home"></i><span
            class="link-text">Accueil</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Bord') ?>"><i class="fas fa-tachometer-alt"></i><span
            class="link-text">Tableau de bord</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-user"></i><span class="link-text">Profil</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="actionDropdown" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="fas fa-tasks"></i> <span class="link-text">Action</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown">
          <?php if ($this->session->userdata('role') === 'admin' ||$this->session->userdata('role') === 'superadmin' 
         || $this->session->userdata('role') === 'Enseignant'): ?>
          <li><a class="dropdown-item" href="<?=base_url('Enseignant') ?>">Enseignant</a></li>
        <?php endif; ?>
          <li><a class="dropdown-item" href="<?= base_url('Eleve') ?>">Élève</a></li>
          <li><a class="dropdown-item" href="<?= base_url('Filiere') ?>">Filière</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="actionDropdown" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="fas fa-cog"></i> <span class="link-text">Param�tres</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown">

          <?php if ($this->session->userdata('role') === 'admin' ||$this->session->userdata('role') === 'superadmin' ): ?>
            <li><a class="dropdown-item" href="<?=base_url('Utilisateur') ?>">utilisateur</a></li>
        <?php endif; ?>
          
          <li><a class="dropdown-item" href="<?= base_url('inscription') ?>">Inscription</a></li>
          <li><a class="dropdown-item" href="<?= base_url('#') ?>">#</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout"><i class="fas fa-user"></i><span class="link-text">deconnection</span></a>
      </li>

      
    </ul>
  </div>

  