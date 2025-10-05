@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="admin-title">Admin</h2>

        <form action="{{ route('admin') }}" method="GET" class="filter-form">
            <div class="filter-area">
                {{-- 名前・メールアドレス検索 --}}
                <input type="text"
                    name="keyword"
                    placeholder="名前やメールアドレスを入力してください"
                    class="text-input input-name-email"
                    value="{{ $filters['keyword'] ?? '' }}">
                {{-- 性別検索 --}}
                <select name="gender" class="dropdown-input input-gender">
                    <option value="" disabled @if(empty($filters['gender'])) selected @endif>性別</option>
                    <option value="">全て</option>
                    @foreach($genderMap as $code => $label)
                        <option value="{{ $code }}" @if(isset($filters['gender']) && (string)$filters['gender'] === (string)$code) selected @endif>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                {{-- お問い合わせの種類検索 --}}
                <select name="category_id" class="dropdown-input input-category_id">
                    <option value="" disabled @if(empty($filters['category_id'])) selected @endif>お問い合わせの種類</option>
                    <option value="">全て</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(isset($filters['category_id']) && (string)$filters['category_id'] === (string)$category->id) selected @endif>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
                {{-- 日付検索 --}}
                <input type="text"
                    name="date"
                    placeholder="年/月/日"
                    onfocus="(this.type='date')"
                    onblur="if(!this.value) this.type='text'"
                    class="dropdown-input input-date"
                    value="{{ $filters['date'] ?? '' }}">
                {{-- 検索ボタン --}}
                <button type="submit" class="search-button">検索</button>
                {{-- リセットボタン --}}
                <a href="{{ route('admin') }}" class="reset-button">リセット</a>
            </div>
        </form>

        <div class="data-area">
            <div class="data-area-header">
                <button class="export-button">エクスポート</button>
                {{ $contacts->links() }}
            </div>

            <table class="contact-table">
                <thead>
                    <tr class="table-header">
                        <th class="col-name">お名前</th>
                        <th class="col-gender">性別</th>
                        <th class="col-email">メールアドレス</th>
                        <th class="col-type">お問い合わせの種類</th>
                        <th class="col-detail"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr class="table-row">
                        <td class="col-name">{{ $contact->first_name . '  ' . $contact->last_name }}</td>
                        <td class="col-gender">{{ $genderMap[$contact->gender] ?? '未回答' }}</td>
                        <td class="col-email">{{ $contact->email }}</td>
                        <td class="col-type">{{ $contact->category->content }}</td>
                        <td class="col-detail">
                            <a href="#modal-{{ $contact->id }}" class="detail-button">詳細</a>
                        </td>
                    </tr>

                    {{-- モーダル --}}
                    <div id="modal-{{ $contact->id }}" class="modal">
                        <div class="modal-content">
                            {{-- 閉じるボタン --}}
                            <a href="#" class="modal-close">&times;</a>

                            <div class="modal-details">
                                {{-- 各項目を row クラスで囲み、項目名と値を separated-label/value で区切る --}}
                                <div class="modal-row">
                                    <span class="label">お名前</span>
                                    <span class="value">{{ $contact->first_name }} {{ $contact->last_name }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">性別</span>
                                    <span class="value">{{ $genderMap[$contact->gender] ?? '未回答' }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">メールアドレス</span>
                                    <span class="value">{{ $contact->email }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">電話番号</span>
                                    <span class="value">{{ $contact->tel }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">住所</span>
                                    <span class="value">{{ $contact->address }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">建物名</span>
                                    <span class="value">{{ $contact->building }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">お問い合わせの種類</span>
                                    <span class="value">{{ $contact->category->content }}</span>
                                </div>
                                <div class="modal-row">
                                    <span class="label">お問い合わせ内容</span>
                                    <span class="value">{{ $contact->detail }}</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form class="delete-form" action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
