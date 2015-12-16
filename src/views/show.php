<main id="show-picture">
    <img src="<?php echo $picture->getPath() ?>" alt="" />
    <?php if ($connected) : ?>
    <h2>Post a comment: </h2>
    <form id="comment-form" action="/comment?id=<?php echo $picture->getId() ?>" method="POST">
        <textarea name="content"></textarea><br />
        <input type="submit" value="Post comment" />
    </form>
    <?php endif ?>
    <h2>Comments: </h2>
    <ul id="comments-section">
        <?php foreach ($comments as $comment) : ?>
        <li>
            <strong><?php echo $comment->getUsername() ?> says :</strong>
            <p><?php echo $comment->getContent() ?></p>
        </li>
        <?php endforeach ?>
    </ul>
    <?php if ($nb_pages > 0) : ?>
    <p>pages: </p>
    <ul id="pagination">
        <?php while ($i <= $nb_pages) : ?>
        <li>
            <?php if ($page == $i) : ?>
            <span class="page"><?php echo $i++ ?></span>
            <?php else : ?>
            <a href="/?page=<?php echo $i ?>">
                <span class="page"><?php echo $i++ ?></span>
            </a>
            <?php endif ?>
        </li>
        <?php endwhile ?>
    </ul>
    <?php endif ?>
</main>
