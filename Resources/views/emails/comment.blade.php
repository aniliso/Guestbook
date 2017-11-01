<div class="guestbook-mail">
    <p>{{ setting('theme::company-name') }} sayfanızda bir ziyaretçi yorumu yapıldı.</p>

    <hr/>

    <table border="0" cellpadding="5" cellspacing="5">
        <tbody>
        <tr>
            <th style="width: 250px;">Adı</th>
            <td>{{ $comment->fullname }}</td>
        </tr>
        <tr>
            <th>Telefon</th>
            <td>{{ $comment->phone }}</td>
        </tr>
        <tr>
            <th>E-Posta</th>
            <td>{{ $comment->email }}</td>
        </tr>
        <tr>
            <th>Yorum</th>
            <td>{{ $comment->message }}</td>
        </tr>
        </tbody>
    </table>

    <hr />

    <p>Yorumu onaylamak için <a href="{{ route('guestbook.comment.approve',[encrypt($comment->id)]) }}">tıklayınız</a></p>
</div>

<style>
.guestbook-mail {
    font-family: Arial, Verdana, "Trebuchet MS", sans-serif;
    padding: 20px;
}
</style>

