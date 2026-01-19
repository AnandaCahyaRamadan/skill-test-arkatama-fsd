<div class="sidebar bg-dark text-white p-3" style="width:250px">
    <h5 class="text-center mb-4">Admin Klinik Hewan</h5>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="/dashboard" class="nav-link text-white {{ Request::is("dashboard") ? "bg-primary rounded" : "" }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="/owners" class="nav-link text-white {{ Request::is("owners*") ? "bg-primary rounded" : "" }}">
                Owner
            </a>
        </li>
        <li class="nav-item">
            <a href="/pets" class="nav-link text-white {{ Request::is("pets*") ? "bg-primary rounded" : "" }}"> 
                Pets
            </a>
        </li>
        <li class="nav-item">
            <a href="/treatements" class="nav-link text-white {{ Request::is("treatements*") ? "bg-primary rounded" : "" }}">
                Treatments
            </a>
        </li>
        <li class="nav-item">
            <a href="/checkups" class="nav-link text-white {{ Request::is("checkups*") ? "bg-primary rounded" : "" }}">
                Checkups
            </a>
        </li>
    </ul>
</div>
