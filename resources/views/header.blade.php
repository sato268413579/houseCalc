@section('header')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">当日登録 <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tomonth" href="/tomonth">当月登録 </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="beforeMonth" href="/beforeMonth">過去月参照</a>
            </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="info" href="/info">問い合わせ</a>
                </li>
            </ul>
        </div>
    </nav>
@endsection