<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1">
</head>
<body>

<header class="header">
    <h1 class="logo">FashionablyLate</h1>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="header-btn">logout</button>
    </form>
</header>

<h2 class="title">Admin</h2>

<!--{{-- 検索フォーム --}}-->
<form method="get" action="{{ route('admin') }}" class="search-form">
    <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">

    <select name="gender">
        <option value="">性別</option>
        <option value="all" {{ request('gender')=='all' ? 'selected' : '' }}>全て</option>
        <option value="1" {{ request('gender')=='1' ? 'selected' : '' }}>男性</option>
        <option value="2" {{ request('gender')=='2' ? 'selected' : '' }}>女性</option>
        <option value="3" {{ request('gender')=='3' ? 'selected' : '' }}>その他</option>
    </select>
<!--{{-- お問い合わせ種類 --}}-->
    <select name="category_id">
        <option value="">お問い合わせの種類</option>
        <option value="1">商品のお届けについて</option>
        <option value="2">商品の交換について</option>
        <option value="3">商品トラブル</option>
        <option value="4">ショップへのお問い合わせ</option>
        <option value="5">その他</option>
    </select>
    <!--{{-- 日付 --}}-->
    <input type="date" name="date" value="{{ request('date') }}">

    <button class="search-btn">検索</button>
    <a href="{{ route('admin') }}" class="reset-btn">リセット</a>
</form>

<form action="{{ route('admin.export') }}" method="get">
<button class="export-btn">エクスポート</button>
</form>
<!--{{-- 詳細一覧 --}}-->
<table class="table">
    <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th></th>
    </tr>

@foreach ($contacts as $contact)
    <tr>
        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
        <td>{{ $contact->gender }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->category->content ?? '' }}</td>
        <td>
            <button class="detail-btn"
                data-id="{{ $contact->id }}"
                data-gender="{{ $contact->gender }}"
                data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                data-email="{{ $contact->email }}"
                data-category="{{ $contact->category->content ?? '' }}"
                data-message="{{ $contact->message }}">
                詳細
            </button>
        </td>
    </tr>
@endforeach

</table>
<!--{{-- モーダル --}}-->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <p><strong>お名前：</strong><span id="modal-name"></span></p>
        <p><strong>性別：</strong><span id="modal-gender"></span></p>
        <p><strong>メール：</strong><span id="modal-email"></span></p>
        <p><strong>お問い合わせの種類：</strong><span id="modal-category"></span></p>
        <p><strong>内容：</strong><br>
            <span id="modal-detail"></span>
        </p>
        <form id="delete-form" method="post">
        @csrf
        @method('DELETE')
        <p style="text-align: center;">
        <button type="submit" class="delete-btn">
        削除
        </button>
        </p>
</form>
    </div>
</div>

<script>
    const modal = document.getElementById('modal');
    const closeBtn = document.querySelector('.close');
    const deleteForm = document.getElementById('delete-form');

    document.querySelectorAll('.detail-btn').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('modal-name').textContent = button.dataset.name;
            document.getElementById('modal-gender').textContent = button.dataset.gender;
            document.getElementById('modal-email').textContent = button.dataset.email;
            document.getElementById('modal-category').textContent = button.dataset.category;
            document.getElementById('modal-detail').textContent = button.dataset.message;

            // ⭐ 削除用URLをセット
            deleteForm.action = `/admin/${button.dataset.id}`;
            
            modal.style.display = 'block';
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', e => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

{{ $contacts->links() }}

</body>
</html>
