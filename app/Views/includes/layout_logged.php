<?= $this->extend('includes/layout') ?>

<?= $this->section('content') ?>
<body class="fixed-sn black-skin">
<!-- Main Navigation -->
<header>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav side wide sn-bg-4 fixed">
        <ul class="custom-scrollbar">
            <!-- Logo -->
            <li class="logo-sn waves-effect py-3">
                <div class="text-center">
                    <a href="#" class="pl-0"><img width="200px" src="<?= base_url('images/logo-total-branca.png') ?>"></a>
                </div>
            </li>
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <!-- Dashboard -->
                    <li>
                        <a href="<?= base_url('/') ?>" class="waves-effect"><i class="w-fa fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <!-- Cadastros -->
                    <li>
                        <a class="collapsible-header waves-effect arrow-r">
                            <i class="w-fa fas fa-boxes"></i>Cadastros<i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a href="<?= base_url('user/') ?>" class="waves-effect"><i class="w-fa fas fa-users"></i> Usuários</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('software/') ?>" class="waves-effect"><i class="w-fa fas fa-desktop"></i> Softwares</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('accounting/') ?>" class="waves-effect"><i class="w-fa fas fa-calculator"></i> Contabilidades</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('client/') ?>" class="waves-effect"><i class="w-fa fas fa-address-card"></i> Clientes</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Financeiro -->
                    <li>
                        <a class="collapsible-header waves-effect arrow-r">
                            <i class="w-fa fas fa-coins"></i>Financeiro<i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a href="<?= base_url('payment-type/') ?>" class="waves-effect"><i class="w-fa fas fa-credit-card"></i> Formas de Pagamento</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Atendimentos -->
                    <li>
                        <a class="collapsible-header waves-effect arrow-r">
                            <i class="w-fa fas fa-clipboard-list"></i>Atendimentos<i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a href="<?= base_url('attendance-scheduling/') ?>" class="waves-effect"><i class="w-fa fas fa-calendar-alt"></i> Agendamentos</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('client-software-update/') ?>" class="waves-effect"><i class="w-fa fas fa-sync-alt"></i> Atualizações</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('attendance-reason/') ?>" class="waves-effect"><i class="w-fa fas fa-book"></i> Motivos</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('attendance-type/') ?>" class="waves-effect"><i class="w-fa fas fa-dolly"></i> Tipos</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('attendance/') ?>" class="waves-effect"><i class="w-fa fas fa-headset"></i> Lançamentos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Side navigation links -->
        </ul>
        <div class="sidenav-bg mask-strong"></div>
    </div>
    <!-- Sidebar navigation -->

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">

        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
        </div>

        <!-- Breadcrumb -->
        <div class="breadcrumb-dn mr-auto">
        </div>

        <!-- Navbar links -->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block"><?= session()->get('name') ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= base_url('/user/logOut') ?>"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </li>
        </ul>
        <!-- Navbar links -->
    </nav>
    <!-- Navbar -->
</header>
<!-- Main layout -->
<main>
    <div class="container-fluid">
        <?= $this->renderSection('container') ?>
    </div>
</main>
</body>
<?= $this->endSection() ?>




