<div class="col-lg-6">
    <div class="about__text">
        <p>
            <?
            $APPLICATION->IncludeComponent("bitrix:main.include", "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/about/part4.php",
                    "EDIT_TEMPLATE" => ""
                ), false, array());
            ?>
        </p>
    </div>
</div>