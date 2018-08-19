<?php View::Load('Default/Header','评论管理'); ?>
<div class="panel panel-default title-alone">
    <div class="panel-body" id="aboutInfo">
        <h3 class="control-title">评论管理</h3>
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">全部 (<?php echo (new Counter(Counter::TypeCommentAll))->getNum(); ?>)</a></li>
            <li role="presentation"><a href="#">待审核 (<?php echo (new Counter(Counter::TypeCommentPending))->getNum(); ?>)</a></li>
            <li role="presentation"><a href="#">垃圾 (<?php echo (new Counter(Counter::TypeCommentSpam))->getNum(); ?>)</a></li>
            <li role="presentation"><a href="#">回收站 (<?php echo (new Counter(Counter::TypeCommentDeleted))->getNum(); ?>)</a></li>
        </ul>

        <table class="table table-hover table-striped">
            <?php foreach($comments as $value): ?>
                <tr>
                    <td style="width: 29%">
                        <div class="media">
                            <div class="media-left">
                                <a <?php if(!empty($value['url'])): ?> href="<?php echo htmlspecialchars($value['url']); ?>" <?php endif; ?>>
                                    <img class="media-object" src="<?php echo getGravatarURL($value['email']); ?>" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                </a>
                            </div>
                            <div class="media-body">
                                <?php if(!empty($value['url'])): ?>
                                    <a href="<?php echo htmlspecialchars($value['url']); ?>" target="_blank" rel="nofollow">
                                <?php endif; ?>
                                    <b><?php echo htmlspecialchars($value['author']); ?></b>
                                <?php if(!empty($value['url'])): ?>
                                    </a>
                                <?php endif; ?>
                                <br/><?php echo htmlspecialchars($value['email']); ?>
                                <br/><span id="comment-ip-"><?php echo htmlspecialchars($value['ip']); ?></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($value['content']); ?>
                        <p>
                        <div class="row-actions">
                            <span class="approve"><a href="">批准</a></span>
                            <span class="reject"><a href="">驳回</a></span>
                            <span class="reply"><a href="">回复</a></span>
                            <span class="edit"><a href="">编辑</a></span>
                            <span class="spam"><a href="">垃圾</a></span>
                            <span class="delete"><a href="">删除</a></span>
                        </p>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php View::Load('Default/Footer'); ?>
