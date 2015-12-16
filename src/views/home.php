<main id="gallery">
    <h2>Gallery</h2>
    <ul id="gallery-pictures">
        <?php foreach ($pictures as $picture) : ?>
        <li>
            <a href="/show?id=<?php echo $picture->getId() ?>">
                <img src="<?php echo $picture->getPath() ?>" width="225" />
            </a>
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
