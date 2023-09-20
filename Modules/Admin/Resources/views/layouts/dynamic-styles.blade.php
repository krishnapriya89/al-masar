<style>
    :root {
        --primary-color: {{ \App\Helpers\AdminHelper::getValueByKey('website_primary_color') }};
        --secondary-color: {{ \App\Helpers\AdminHelper::getValueByKey('website_secondary_color') }};
        --tertiary-color: {{ \App\Helpers\AdminHelper::getValueByKey('website_tertiary_color') }};
    }

    a:hover {
        color: var(--primary-color);
    }

    .main-sidebar {
        background: var(--primary-color);
    }

    .btn-primary {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--secondary-color);
    }

    .btn-primary:hover {
        background: var(--secondary-color);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .btn-primary:disabled:not(:hover),
    .btn-primary:not(:disabled):not(.disabled).active,
    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-primary:not(:disabled):not(.disabled).focus,
    .btn-primary:not(:disabled):not(.disabled):focus,
    .show>.btn-primary.dropdown-toggle,
    .btn-primary.focus,
    .btn-primary:focus {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--secondary-color);
    }

    .nav-sidebar .nav-item>.nav-link {
        color: var(--secondary-color);
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        color: var(--secondary-color);
        background: var(--tertiary-color);
    }

    .nav-sidebar .nav-treeview>.nav-item>.nav-link.active {
        color: var(--primary-color);
        background: var(--secondary-color);
    }

    .nav-sidebar .nav-treeview>.nav-item>.nav-link.active:hover {
        color: var(--primary-color);
        background: var(--secondary-color);
    }

    .main-sidebar>.brand-link {
        color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .breadcrumb-item a,
    .main-footer strong a {
        color: var(--primary-color);
    }

    .page-item.active .page-link {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--secondary-color);
    }

    .card-primary.card-outline {
        border-color: var(--primary-color);
    }

    .icheck-primary>input:first-child:checked+input[type=hidden]+label::before,
    .icheck-primary>input:first-child:checked+label::before {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .icheck-primary>input:first-child:not(:checked):not(:disabled):hover+input[type=hidden]+label::before,
    .icheck-primary>input:first-child:not(:checked):not(:disabled):hover+label::before {
        border-color: var(--primary-color);
    }

    .nav-tabs .nav-link {
        color: var(--primary-color);
    }
</style>
<script>
    var primary_color = '{{ \App\Helpers\AdminHelper::getValueByKey('website_primary_color') }}';
    var secondary_color = '{{ \App\Helpers\AdminHelper::getValueByKey('website_secondary_color') }}';
    var tertiary_color = '{{ \App\Helpers\AdminHelper::getValueByKey('website_tertiary_color') }}';
</script>
