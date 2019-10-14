<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include "components/page_header.php";
    $baseURL = 'http://www.hjle.qdedu.net/';//base_url();
    $baseURL = base_url();
    ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/index.css') ?>">
    <title>首页</title>
</head>
<body>
<div>
    <?php include "components/page_menu.php"; ?>

    <?php $this->load->view("components/resource_toolbar"); ?>

    <div class="slider-bar owl-carousel">
        <?php
        foreach ($banners as $item) {
            echo '<div class="owl-item" style="cursor: pointer"><a href="javascript:;">'
                . '<img src="' . base_url() . 'uploads/' . $item->icon_path . '"/></a></div>';
        }
        ?>

    </div>

    <div class="contents">
        <div class="section">
            <div class="section-header-line"></div>
            <div class="section-title">资源精选</div>
            <div class="section-content">
                <?php
                foreach ($recommend_contents as $item) {
                    $usages = $this->usage_m->get_where(['content_id' => $item->content_id]);
                    $usage_like_count = 0;
                    $usage_like_mine = 0;
                    $usage_read_mine = 0;
                    $usage_read_count = 0;
                    $usage_id = 0;
                    if ($usages != null) {
                        foreach ($usages as $usage) {
                            if ($usage->is_like > 0) {
                                $usage_like_count++;
                                if ($usage->user_id == $this->session->userdata('loginuserID')) {
                                    $usage_like_mine = 1;
                                    $usage_id = $usage->id;
                                }
                            }
                            if ($usage->read_count > 0) {
                                $usage_read_count += $usage->read_count;
                                if ($usage->user_id == $this->session->userdata('loginuserID')) $usage_read_mine += $usage->read_count;
                            }
                        }
                    }
					$contentStr = $item->content;
					//if(mb_strlen($contentStr, 'UTF-8')>14) $contentStr = mb_substr($contentStr, 0,14, 'UTF-8').'...';
                    echo '<div class="content-item">'
                        . '<div class="content-image" onclick="window.open(\'' . $baseURL . 'resource/warePreviewPlayer/' . $item->content_id . '\',\'_blank\')" '
                        . ' style="background-image: '
                        . 'url(' . $baseURL . $item->icon_corner
                        . '),url(' . $baseURL . $item->icon_path . ');cursor: pointer;"></div>'
                        . '<div class="content-title" '
                        . ' style="height: 45px;line-height: 45px;color: black;font-size: 22px;cursor: pointer;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">'
                        . $contentStr . '</div>'
                        . '<div class="content-title">'
                        . $item->content_type . '</div>'
                        . '<div class="content-title">'
                        . $item->subject . ' ' . $item->term . '</div>';
                    echo '<div class="item-infobar">';
                    echo '<div class="item-read-icon" data-sel="' . ($usage_read_mine != null ? 1 : 0) . '" style="margin-right:0;"></div>';
                    echo '<div class="item-read-value" style="margin-left: 0;">' . $usage_read_count . '</div>';
                    echo '<div class="item-favor-icon ' . ($usage_like_mine > 0 ? 'active' : '') . '" data-type="content" data-sel="' . $usage_like_mine . '" data-content_id="' . $item->content_id . '" data-usage_id="' . $usage_id . '" style="margin-right: 0;cursor: default;"></div>';
                    echo '<div class="item-favor-value" style="margin-left: 0;">' . $usage_like_count . '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <a class="section-title" href="<?= base_url('resource') ?>">查看全部资源 》</a>
        </div>
        <div class="section">
            <div class="section-header-line"></div>
            <div class="section-title">课件精选</div>
            <div class="section-content">
                <?php
                foreach ($recommend_lessons as $item) {
                    $usages = $this->usage_m->get_where(['lesson_id' => $item->content_id]);
                    $usage_like_count = 0;
                    $usage_like_mine = 0;
                    $usage_read_mine = 0;
                    $usage_read_count = 0;
                    $usage_id = 0;
                    if ($usages != null) {
                        foreach ($usages as $usage) {
                            if ($usage->is_like > 0) {
                                $usage_like_count++;
                                if ($usage->user_id == $this->session->userdata('loginuserID')) {
                                    $usage_like_mine = 1;
                                    $usage_id = $usage->id;
                                }
                            }
                            if ($usage->read_count > 0) {
                                $usage_read_count += $usage->read_count;
                                if ($usage->user_id == $this->session->userdata('loginuserID')) $usage_read_mine += $usage->read_count;
                            }
                        }
                    }
					
					$contentStr = $item->lesson;
					//if(mb_strlen($contentStr, 'UTF-8')>14) $contentStr = mb_substr($contentStr, 0,14, 'UTF-8').'...';
                    echo '<div class="content-item">'
                        . '<div class="content-image" onclick="window.open(\'' . $baseURL . 'resource/previewPlayer/' . $item->content_id . '\',\'_blank\')" '
                        . ' style="background-image: url(' . $baseURL . $item->icon_path . '); cursor: pointer;"></div>'
                        . '<div class="content-title" '
                        . ' style="height: 45px;line-height: 45px;color: black;font-size: 22px;cursor: pointer;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">'
                        . $contentStr . '</div>'
                        . '<div class="content-title">'
                        . $item->subject . ' ' . $item->term . '</div>';
                    echo '<div class="item-infobar">';
                    echo '<div class="item-read-icon" data-sel="' . ($usage_read_mine != null ? 1 : 0) . '" style="margin-right:0;"></div>';
                    echo '<div class="item-read-value" style="margin-left: 0;">' . $usage_read_count . '</div>';
                    echo '<div class="item-favor-icon ' . ($usage_like_mine > 0 ? 'active' : '') . '" data-type="lesson" data-sel="' . $usage_like_mine . '" data-content_id="' . $item->content_id . '" data-usage_id="' . $usage_id . '" style="margin-right: 0;cursor: default;"></div>';
                    echo '<div class="item-favor-value" style="margin-left: 0;">' . $usage_like_count . '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <a class="section-title" style="margin-bottom: 50px;" href="<?= base_url('resource/education') ?>">查看全部课件
                》</a>
        </div>

    </div>

    <?php include "components/page_footer.php"; ?>
    <script>
        if(false && isMobile) location.href=baseURL+'student';
        else $('body').show();

        $('.tab-search').remove();
        $('.tab-item[data-id="0"]').attr('data-sel', 1);
        $('.owl-carousel').owlCarousel({
            items: 1,
            nav: true,
            dots: true,
            autoplay: true,
            loop: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            mouseDrag: true,
            touchDrag: true,
            smartSpeed: 1200
        });

        var isProcessing = false;
        var user_id = '<?= $this->session->userdata('loginuserID') ?>';

        function refreshEvent() {
            $('.item-favor-icon').off('click')
            $('.item-favor-icon').on('click', function (e) {
                e.preventDefault();
                return;
                var that = $(this);
                var like = that.attr('data-sel');
                var likeNum = parseInt(that.parent().children('.item-favor-value').text());
                if (like == '0') {
                    like = '1';
                    likeNum++
                } else if (like == '1') {
                    like = '0';
                    likeNum--
                }
                var content_id = that.attr('data-content_id');
                var usage_id = that.attr('data-usage_id');

                if (isProcessing) return;
                isProcessing = true;
                var submitData = {
                    usage_id: usage_id,
                    user_id: user_id,
                    like: like
                };
                if (that.attr('data-type') == 'content') submitData.content_id = content_id;
                else submitData.lesson_id = content_id;
                jQuery.ajax({
                    type: "post",
                    url: baseURL + "resource/" + that.attr('data-type') + "_like",
                    dataType: "json",
                    data: submitData,
                    success: function (res) {
                        if (res.status == 'success') {
                            that.attr('data-sel', like);
                            that.parent().children('.item-favor-value').text(likeNum)
                        } else//failed
                        {
                            alert("Cannot update lesson Item.");
                        }
                    },
                    complete: function () {
                        isProcessing = false;
                    }
                });
            });
        }

        refreshEvent();
    </script>
</div>
</body>
</html>