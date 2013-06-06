<table class="table table-striped">
    <thead>
        <tr>
            <th># </th>
            <th>제목 </th>
            <th>발행일</th>
            <th></th>
        </tr>
    </thead> 
    <tbody>
        <?php foreach($article_list as $key => $article): ?>
        <tr data_id="<?=$article['id']?>">
            <td><?=$article['id']?></td>
            <td><?=$article['title']?><br/><?=$article['link']?></td>
            <td><?=$feed['pub_date']?></td>
            <td><button class="btn btn-info" >수정</button> <button class="btn btn-danger del_btn">삭제 </button> </td>
        </tr>
        <?php endforeach;?> 
    </tbody>
</table> 
