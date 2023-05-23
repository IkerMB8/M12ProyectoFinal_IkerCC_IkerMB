{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
@hasanyrole('admin|trabajador')
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="las la-user-tie"></i> Users</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('trabajador') }}"><i class="las la-briefcase"></i> Trabajadors</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('servicio') }}"><i class="las la-question-circle"></i> Servicios</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('cliente') }}"><i class="las la-user"></i> Clientes</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('producto') }}"><i class="las la-cube"></i> Productos</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
@else
   {{ __("Only admins and employees can see this section") }}
@endhasanyrole
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('reserva') }}"><i class="nav-icon la la-question"></i> Reservas</a></li>