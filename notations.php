<?php

if (true) {
    echo "C'est vrai";
}

$i = 0;

while ($i < 3) {
    echo $i;
    $i++;
}

// il y a la même notation pour :
// - la boucle for (for et endfor)
// - la boucle foreach (foreach et endforeach)

?>
<?php if (true): ?>
<p>
C'est vrai
</p>
<?php endif ?>

<?php
$i = 0;
?>
<ul>
<?php while ($i < 3): ?>
    <li><?= $i ?></li>
<?php endwhile ?>
</ul>
