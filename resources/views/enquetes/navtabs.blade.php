<ul class="nav nav-tabs nav-justified mb-3">
    <li class="nav-item">
        <a href="{{ route('enquetes.index_type', ["page_type" => $page_type = "1"] ) }}" class="nav-link {{ Request::is('enquetes/index/1')? 'active':'' }}">
            <i class="far fa-heart"></i> お気に入り
            <span class="badge badge-secondary">
                {{ $count_favorites }}
            </span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('enquetes.index_type', ["page_type" => $page_type = "2"] ) }}" class="nav-link {{ Request::is('enquetes/index/2')? 'active':'' }}">
            <i class="far fa-star"></i> マイ・アンケート
            <span class="badge badge-secondary">
                {{ $count_my_enquetes }}
            </span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('enquetes.index_type', ["page_type" => $page_type = "3" ]) }}" class="nav-link {{ Request::is('enquetes/index/3')? 'active':'' }}">
            <i class="far fa-eye"></i> アンケート閲覧
            <span class="badge badge-secondary">
                {{ $count_the_others }}
            </span>
        </a>
    </li>
</ul>