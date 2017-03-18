<main>
    <h2>Welcome <?php echo $_SESSION['login'] ?></h2>
    <a href="/account/new">Add a new picture</a>

    <ul id="account-pictures">
        <?php foreach ($pictures as $picture) : ?>
        <li>
            <a href="/show?id=<?php echo $picture->getId() ?>"><img src="<?php echo $picture->getPath() ?>" width="225" /></a>
            <a href="/account/delete?id=<?php echo $picture->getId() ?>">Delete</a>
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
