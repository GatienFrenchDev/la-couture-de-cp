<?php
require_once 'fonctions.php';
?>

<nav aria-label="Pagination" class="flex justify-center content-center">
    <ul class="inline-flex space-x-2 pb-24">
        <?php
        if ($id_page != 1) {
        ?>
            <a href="<?= $page ?>?id_page=1<?= getQueryWithoutIdPage() ?>">
                <li><button class="flex items-center justify-center w-10 h-10 text-pink-500 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-pink-100">
                        <svg  class="w-3 h-3 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120.64 122.88" style="enable-background:new 0 0 120.64 122.88" xml:space="preserve">
                            <g>
                                <path d="M66.6,108.91c1.55,1.63,2.31,3.74,2.28,5.85c-0.03,2.11-0.84,4.2-2.44,5.79l-0.12,0.12c-1.58,1.5-3.6,2.23-5.61,2.2 c-2.01-0.03-4.02-0.82-5.55-2.37C37.5,102.85,20.03,84.9,2.48,67.11c-0.07-0.05-0.13-0.1-0.19-0.16C0.73,65.32-0.03,63.19,0,61.08 c0.03-2.11,0.85-4.21,2.45-5.8l0.27-0.26C20.21,37.47,37.65,19.87,55.17,2.36C56.71,0.82,58.7,0.03,60.71,0 c2.01-0.03,4.03,0.7,5.61,2.21l0.15,0.15c1.57,1.58,2.38,3.66,2.41,5.76c0.03,2.1-0.73,4.22-2.28,5.85L19.38,61.23L66.6,108.91 L66.6,108.91z M118.37,106.91c1.54,1.62,2.29,3.73,2.26,5.83c-0.03,2.11-0.84,4.2-2.44,5.79l-0.12,0.12 c-1.57,1.5-3.6,2.23-5.61,2.21c-2.01-0.03-4.02-0.82-5.55-2.37C89.63,101.2,71.76,84.2,54.24,67.12c-0.07-0.05-0.14-0.11-0.21-0.17 c-1.55-1.63-2.31-3.76-2.28-5.87c0.03-2.11,0.85-4.21,2.45-5.8C71.7,38.33,89.27,21.44,106.8,4.51l0.12-0.13 c1.53-1.54,3.53-2.32,5.54-2.35c2.01-0.03,4.03,0.7,5.61,2.21l0.15,0.15c1.57,1.58,2.38,3.66,2.41,5.76 c0.03,2.1-0.73,4.22-2.28,5.85L71.17,61.23L118.37,106.91L118.37,106.91z" />
                            </g>
                        </svg></button>
                </li>
            </a>
            <a href="<?= $page ?>?id_page=<?= ($id_page - 1) . getQueryWithoutIdPage() ?>">
                <li><button class="flex items-center justify-center w-10 h-10 text-pink-500 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-pink-100">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg></button>
                </li>
            </a>
            <a href="<?= $page ?>?id_page=<?= ($id_page - 1) . getQueryWithoutIdPage() ?>">
                <li><button class="w-10 h-10 text-pink-500 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-pink-100"><?= $id_page - 1 ?></button></li>
            </a>
        <?php
        }
        ?>
        <a href="<?= $page ?>?id_page=<?= ($id_page) . getQueryWithoutIdPage() ?>">
            <li><button class="w-10 h-10 text-white transition-colors duration-150 bg-pink-500 border border-r-0 border-pink-500 rounded-full focus:shadow-outline"><?= $id_page ?></button></li>
        </a>
        <?php
        if ($id_page != $nbr_page_total) {
        ?>
            <a href="<?= $page ?>?id_page=<?= ($id_page + 1) . getQueryWithoutIdPage() ?>">
                <li><button class="w-10 h-10 text-pink-500 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-pink-100"><?= $id_page + 1 ?></button></li>
            </a>
            <a href="<?= $page ?>?id_page=<?= ($id_page + 1) . getQueryWithoutIdPage() ?>">
                <li><button class="flex items-center justify-center w-10 h-10 text-pink-500 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-pink-100">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg></button>
                </li>
            </a>
            <a href="<?= $page ?>?id_page=<?= ($nbr_page_total) . getQueryWithoutIdPage() ?>">
                <li><button class="flex items-center justify-center w-10 h-10 text-pink-500 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-pink-100">
                        <svg class="w-3 h-3 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120.64 122.88" style="enable-background:new 0 0 120.64 122.88" xml:space="preserve">
                            <g>
                                <path d="M54.03,108.91c-1.55,1.63-2.31,3.74-2.28,5.85c0.03,2.11,0.84,4.2,2.44,5.79l0.12,0.12c1.58,1.5,3.6,2.23,5.61,2.2 c2.01-0.03,4.01-0.82,5.55-2.37c17.66-17.66,35.13-35.61,52.68-53.4c0.07-0.05,0.13-0.1,0.19-0.16c1.55-1.63,2.31-3.76,2.28-5.87 c-0.03-2.11-0.85-4.21-2.45-5.8l-0.27-0.26C100.43,37.47,82.98,19.87,65.46,2.36C63.93,0.82,61.93,0.03,59.92,0 c-2.01-0.03-4.03,0.7-5.61,2.21l-0.15,0.15c-1.57,1.58-2.38,3.66-2.41,5.76c-0.03,2.1,0.73,4.22,2.28,5.85l47.22,47.27 L54.03,108.91L54.03,108.91z M2.26,106.91c-1.54,1.62-2.29,3.73-2.26,5.83c0.03,2.11,0.84,4.2,2.44,5.79l0.12,0.12 c1.57,1.5,3.6,2.23,5.61,2.21c2.01-0.03,4.02-0.82,5.55-2.37C31.01,101.2,48.87,84.2,66.39,67.12c0.07-0.05,0.14-0.11,0.21-0.17 c1.55-1.63,2.31-3.76,2.28-5.87c-0.03-2.11-0.85-4.21-2.45-5.8C48.94,38.33,31.36,21.44,13.83,4.51l-0.12-0.13 c-1.53-1.54-3.53-2.32-5.54-2.35C6.16,2,4.14,2.73,2.56,4.23L2.41,4.38C0.84,5.96,0.03,8.05,0,10.14c-0.03,2.1,0.73,4.22,2.28,5.85 l47.18,45.24L2.26,106.91L2.26,106.91z" />
                            </g>
                        </svg></button>
                </li>
            </a>
        <?php
        }
        ?>
    </ul>
</nav>