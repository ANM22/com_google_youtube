<?php

/**
 * Plugin to embed a YouTube video.
 */
class com_google_youtube_video extends com_anm22_wb_editor_page_element
{

    var $elementClass = "com_google_youtube_video";
    var $elementPlugin = "com_google_youtube";
    var $elementClassName = "YouTube";
    var $elementClassIcon = "images/plugin_icons/com_google_youtube.png";
    var $title;
    var $videoId;
    var $description;
    var $width;
    var $height;
    var $cssClass;

    /**
     * @deprecated since editor 3.0
     * 
     * Method to init the element.
     * 
     * @param SimpleXMLElement $xml Element data
     * @return void
     */
    function importXMLdoJob($xml)
    {
        $this->title = $xml->title;
        $this->videoId = $xml->videoId;
        $this->description = htmlspecialchars_decode($xml->description);
        $this->width = $xml->width;
        $this->height = $xml->height;
        $this->cssClass = htmlspecialchars_decode($xml->cssClass);
    }

    /**
     * Method to init the element.
     * 
     * @param mixed[] $data Element data
     * @return void
     */
    public function initData($data)
    {
        $this->title = $data['title'];
        $this->videoId = $data['videoId'];
        if (isset($data['description']) && $data['description']) {
            $this->description = htmlspecialchars_decode($data['description']);
        }
        $this->width = $data['width'] ?? null;
        $this->height = $data['height'] ?? null;
        if (isset($data['cssClass']) && $data['cssClass']) {
            $this->cssClass = htmlspecialchars_decode($data['cssClass']);
        }
    }

    /**
     * Render the page element
     * 
     * @return void
     */
    function show()
    {
        $max_width = $this->width;
        if (!$max_width || ($max_width == "")) {
            $max_width = "600px";
        }
        $height = $this->height;
        if (!$height || ($height == "")) {
            $height = "315px";
        }
        ?>
        <div class="<?= $this->elementPlugin ?>_<?= $this->elementClass ?> <?= $this->cssClass ?>">
            <?
            if ($this->title && $this->title != "") {
                ?>
                <h1 style="color:<?= $this->page->pageOptions["h1-color"] ?>;"><?= $this->title ?></h1>
                <?
            }
            if ($this->videoId && $this->videoId != "") {
                ?>
                <iframe src="//www.youtube.com/embed/<?= $this->videoId ?>?rel=0" frameborder="0" allowfullscreen style="width:100%; max-width:<?= $max_width ?>; height:<?= $height ?>;"></iframe>
                <?
            }
            if ($this->description && $this->description != "") {
                ?>
                <p style="color:<?= $this->page->pageOptions["p-color"] ?>;"><?= nl2br($this->description) ?></p>
                <?
            }
            ?>
        </div>
        <?
    }
}