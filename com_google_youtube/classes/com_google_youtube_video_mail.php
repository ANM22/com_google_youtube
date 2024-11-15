<?php

/**
 * Plugin to include a preview of a YouTube video inside an e-mail.
 */
class com_google_youtube_video_mail extends com_anm22_wb_editor_page_element
{

    var $elementClass = "com_google_youtube_video_mail";
    var $elementPlugin = "com_google_youtube";
    var $elementClassName = "YouTube";
    var $elementClassIcon = "images/plugin_icons/com_google_youtube.png";
    var $title;
    var $videoId;
    var $description;
    var $width;
    var $height;

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
    }

    /**
     * Render the page element
     * 
     * @return void
     */
    function show()
    {
        $max_width = $this->width;
        if ((!$max_width) or ($max_width == "")) {
            $max_width = "600px";
        }
        $height = $this->height;
        if ((!$height) or ($height == "")) {
            $height = "315px";
        }
        ?>
        <div class="<?= $this->elementPlugin ?>_<?= $this->elementClass ?>">
            <?
            if ($this->title != "") {
            ?>
                <h1 style="color:<?= $this->page->pageOptions["h1-color"] ?>;"><?= $this->title ?></h1>
            <?
            }
            if ($this->videoId != "") {
            ?>
                <div style="position:relative;">
                    <a href="https://www.youtube.com/watch?v=<?= $this->videoId ?>">
                        <img src="http://img.youtube.com/vi/<?= $this->videoId ?>/maxresdefault.jpg" style="width:100%; height:<?= $height ?>; border:0px; margin:auto; max-width:<?= $max_width ?>; display:block;" />
                        <img src="../../ANM22WebBase/website/plugins/com_google_youtube/img/yt_icon.png" style=" position: absolute; width:66px; height:46px; margin-left:-33px; margin-top:-23px; left:50%; border:0px; top:50%;" />
                    </a>
                </div>
            <?
            }
            if ($this->description != "") {
            ?>
                <p style="color:<?= $this->page->pageOptions["p-color"] ?>;"><?= nl2br($this->description) ?></p>
            <?
            }
            ?>
        </div>
        <?
    }
}