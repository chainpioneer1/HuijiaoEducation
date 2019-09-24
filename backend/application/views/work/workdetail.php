<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/workdetail.css') ?>">
<script>
    var imageDir = baseURL + "assets/images/class/";
</script>

<div class="main-resource-toolbar">
    <a style="font-size: 12px; font-weight: bold; " class="tab-item1">作业详情</a>
</div>
<div class="base-container" style="height: auto;margin-bottom:20px; ">
    <div class="sec-wrap select-question-wrap">

        <div class="body-sec question-sec" style="border-top: none; padding-top: 0">
            <?php
            $questionTypes = ["选择", "判断", "填空"];
            $questionTitles = ["选择题", "判断题", "填空题"];
            $difficultyTypes = ['简单', '较难', '困难'];
            ?>
            <?php foreach ($questions as $question) : ?>
            <?php $courseType = $this->coursetype_m->get_single(['id'=>$question->course_type_id]);?>
            <div class="question-elem">
                <div class="question-title-sec">
                    <div class="info-group">
                        <span><?= $questionTypes[$question->question_type]?></span>
                        <span><?= $difficultyTypes[$question->difficult_type] ?></span>
                        <span><?= $courseType->title ?></span>

                    </div>

                    <?php
                    $count = 0;
                    foreach ( $students as $student ){
                        $w = $student['work'];
                        if( $w != NULL ){
                            $answer_info = json_decode( $w->answer_info );
                            for( $i=0; $i<count($answer_info); $i++ ){
                                if( $question->id == $answer_info[$i]->id && !$answer_info[$i]->is_right ){
                                    $count++;
                                    break;
                                }
                            }
                        }
                    }
                    ?>
                    <span style="float: right; margin-right: 30px; background-color: #efefef" onclick="window.location = '<?= base_url('work/workwrong/' . $work->id . '/' . $question->id) ?>'">本题错误学生<span style="padding: 0; margin-left: 50px;"><?= $count ?>人>></span></span>
                </div>
                <div class="question-body-sec">
                    <div class="question-body">
                        <div class="section" data-type="title">
                            <?= $questionTitles[$question->question_type]?>。
                        </div>
                        <div class="section" data-type="content">
                            <?= $question->question_content ?>
                        </div>
                        <div class="section" data-type="answer">
                            <?php
                            $content = json_decode($question->question_answer);
                            $type = $question->question_type;
                            if( $type == 0 ){
                                $keys = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
                                    "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
                                    "U", "V", "W", "X", "Y", "Z"
                                ];
                                for( $i=0; $i<count($content); $i++ ){
                            ?>
                            <div class="answer-item" style="margin-bottom: 10px; border-radius: 10px; background-color: #fff;">
                                <div class="item-title" style="display: inline-block; vertical-align: middle; padding: 7px 10px; margin-right: 2px; border-right: 1px solid #f1f5f6"><?= $keys[$i] ?></div>
                                <div class="item-content" style="display: inline-block; vertical-align: middle; padding: 7px 10px;"><?= $content[$i]->content ?></div>
                            </div>
                            <?php
                                }
                            } else if( $type == 1 ){
                                $keys = ["是", "否"];
                                for( $i=0; $i<count($content); $i++ ){
                            ?>
                                    <div class="answer-item" style="margin-bottom: 5px;">
                                        <input type="radio" name="answerRadio" data-id="<?= $i ?>" style="display: inline-block; vertical-align: middle; margin: 0"/>
                                        <div class="item-title" style="display: inline-block; vertical-align: middle"><?= $keys[$i] ?></div>
                                    </div>
                            <?php
                                }
                            } else {

                            }
                            ?>
                        </div>

                    </div>
                </div>
                <div class="question-solver-sec">
                    <?php
                    $str = '';
                    $content = json_decode($question->question_answer);
                    $type = $question->question_type;
                    if( $type == 0 ){
                        $keys = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
                            "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
                            "U", "V", "W", "X", "Y", "Z"
                        ];
                        for( $i=0; $i<count($content); $i++ ){
                            if( $content[$i]->is_checked ){
                                $str .= $keys[$i] . "，";
                            }
                        }
                    } else if( $type == 1 ){
                        $keys = ["是", "否"];
                        for( $i=0; $i<count($content); $i++ ){
                            if( $content[$i]->is_checked ){
                                $str .= $keys[$i] . "，";
                            }
                        }
                    } else {
                        for( $i=0; $i<count($content); $i++ ){
                            if( $content[$i]->is_checked ){
                                $str .= $content[$i]->content . "，";
                            }
                        }
                    }
                    $str = trim($str, "，");
                    ?>
                    <p>正确答案： <?= $str ?></p>
                    <p>本题解析： <?= $question->question_description ?></p>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>


<div class="publish-modal-wrap">
    <div class="edit-info-modal">
        <div class="edit-modal-header">
            <h5>选择班级</h5>
        </div>
        <div class="edit-modal-body">
            <p style="text-align: center">本次作业将发送至<span id="publish-class-str"></span>的</p>
            <p style="text-align: center">学生，确认布置吗？</p>

            <div class="info-confirm-btn" onclick="onPublishConfirm()">
                <span>确定</span>
            </div>
            <div class="info-confirm-btn" onclick="onClosePublishModal()">
                <span>取消</span>
            </div>
        </div>
    </div>
</div>


<script>
    var user_id = <?= $this->session->userdata('loginuserID') ?>;
</script>
<script src="<?= base_url('assets/js/workdetail.js') ?>" type="text/javascript"></script>

<script>


</script>