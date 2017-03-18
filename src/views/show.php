<main id="show-picture">
    <img src="<?php echo $picture->getPath() ?>" alt="" />
    <p><?php echo $likes ?> Likes</p>
    <a href="/like?id=<?php echo $picture->getId() ?>">
    <?php if ($hasLiked) : ?>
        You already liked this picture!
    <?php else : ?>
        Do you like it?
    <?php endif ?>
     </a>
    <?php if ($connected) : ?>
    <h2>Post a comment: </h2>
    <form id="comment-form" action="/comment?id=<?php echo $picture->getId() ?>" method="POST">
        <textarea name="content"></textarea><br />
        <input type="submit" value="Post comment" />
    </form>
    <?php endif ?>
    <h2>Comments: </h2>
    <ul id="comments-section">
        <?php if (empty($comments)) echo "There's no comments" ?>
        <?php foreach ($comments as $comment) : ?>
        <li>
            <p>
                <strong><?php echo $comment->getUsername() ?> says :</strong>
                <?php echo $comment->getContent() ?>
            </p>
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
            <a href="/show?id=<?php echo $picture->getId() ?>&page=<?php echo $i ?>">
                <span class="page"><?php echo $i++ ?></span>
            </a>
            <?php endif ?>
        </li>
        <?php endwhile ?>
    </ul>
    <?php endif ?>
</main>
