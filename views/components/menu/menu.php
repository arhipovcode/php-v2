<nav class="header-nav">
    <ul class="header-nav__list">
        <?php foreach ($menuItems as $item): ?>
            <li class="header-nav__list-item">
                <a href="<?php echo $item['link']; ?>" style="color:<?php echo $item['color']; ?>"
                   class="header-nav__link">
                    <?php echo $item['title']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
