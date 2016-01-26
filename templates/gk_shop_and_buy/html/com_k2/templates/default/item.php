<?php

/**
 * @package		K2
 * @author		GavickPro http://gavick.com
 */

// no direct access
defined('_JEXEC') or die;

// Code used to generate the page elements
$params = $this->item->params;
$k2ContainerClasses = (($this->item->featured) ? ' itemIsFeatured' : '') . ($params->get('pageclass_sfx')) ? ' '.$params->get('pageclass_sfx') : ''; 

?>
<?php if(JRequest::getInt('print')==1): ?>

<a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print(); return false;"> <?php echo JText::_('K2_PRINT_THIS_PAGE'); ?> </a>
<?php endif; ?>
<article id="k2Container" class="itemView<?php echo $k2ContainerClasses; ?>"> <?php echo $this->item->event->BeforeDisplay; ?> <?php echo $this->item->event->K2BeforeDisplay; ?>
          <?php if(isset($this->item->editLink)): ?>
          <a class="itemEditLink modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>"><?php echo JText::_('K2_EDIT_ITEM'); ?></a>
          <?php endif; ?>
          <?php if($params->get('itemImage') && !empty($this->item->image)): ?>
          <div class="itemImageBlock"> <a class="itemImage modal" rel="{handler: 'image'}" href="<?php echo $this->item->imageXLarge; ?>" title="<?php echo JText::_('K2_CLICK_TO_PREVIEW_IMAGE'); ?>"> <img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" /> </a>
                    <?php if($params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
                    <span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
                    <?php endif; ?>
                    <?php if($params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
                    <span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
                    <?php endif; ?>
          </div>
          <?php endif; ?>
          <header>
                    <?php if($params->get('itemTitle')): ?>
                    <h1> <?php echo $this->item->title; ?>
                              <?php if($params->get('itemFeaturedNotice') && $this->item->featured): ?>
                              <sup><?php echo JText::_('K2_FEATURED'); ?></sup>
                              <?php endif; ?>
                    </h1>
                    <?php endif; ?>

          </header>
          <?php echo $this->item->event->AfterDisplayTitle; ?> <?php echo $this->item->event->K2AfterDisplayTitle; ?>
          <div class="itemBody"> <?php echo $this->item->event->BeforeDisplayContent; ?> <?php echo $this->item->event->K2BeforeDisplayContent; ?>
                    <?php if(!empty($this->item->fulltext)): ?>
                    <?php if($params->get('itemIntroText')): ?>
                    <div class="itemIntroText"> <?php echo $this->item->introtext; ?> </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if($params->get('itemFullText')): ?>
                    <div class="itemFullText"> <?php echo (!empty($this->item->fulltext)) ? $this->item->fulltext : $this->item->introtext; ?> </div>
                    <?php endif; ?>
                    <?php if(($params->get('itemDateModified') && intval($this->item->modified)!=0)): ?>
                    <div class="itemBottom">
                              <?php if($params->get('itemDateModified') && intval($this->item->modified) != 0 && $this->item->created != $this->item->modified): ?>
                              <small class="itemDateModified"> <?php echo JText::_('K2_LAST_MODIFIED_ON') . JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?> </small>
                              <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if($params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
                    <div class="itemExtraFields">
                              <h3><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h3>
                              <ul>
                                        <?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
                                        <?php if($extraField->value != ''): ?>
                                        <li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
                                                  <?php if($extraField->type == 'header'): ?>
                                                  <h4 class="itemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
                                                  <?php else: ?>
                                                  <span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?>:</span> <span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
                                                  <?php endif; ?>
                                        </li>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                              </ul>
                    </div>
                    <?php endif; ?>
                    <?php echo $this->item->event->AfterDisplayContent; ?> <?php echo $this->item->event->K2AfterDisplayContent; ?>
                    <?php if(
				$params->get('itemTags') ||
				$params->get('itemTwitterButton',1) || 
				$params->get('itemFacebookButton',1) || 
				$params->get('itemGooglePlusOneButton',1) ||
				$params->get('itemAttachments') ||
				$params->get('itemRating')
			): ?>
                    <div class="itemLinks">



                              <?php if($params->get('itemTwitterButton',1) || $params->get('itemFacebookButton',1) || $params->get('itemGooglePlusOneButton',1)): ?>
                              <div class="itemSocialSharing">
                                  <div class="vk_share_button" style="float: left; margin-right: 10px;">
                                      <div id="vk_share_button">
                                      </div>
                                      <script type="text/javascript">
                                          VK.init({apiId:'4590275', onlyWidgets: true});
                                      </script>
                                      <script type="text/javascript">
                                          VK.Widgets.Like('vk_share_button'
                                          );
                                      </script>
                                  </div>
                                        <?php if($params->get('itemTwitterButton',1)): ?>
                                        <div class="itemTwitterButton"> <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal"<?php if($params->get('twitterUsername')): ?> data-via="<?php echo $params->get('twitterUsername'); ?>"<?php endif; ?>><?php echo JText::_('K2_TWEET'); ?></a> 
                                                  <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script> 
                                        </div>
                                        <?php endif; ?>
                                        <?php if($params->get('itemFacebookButton',1)): ?>
                                        <div class="itemFacebookButton"> 
                                                  <script type="text/javascript">                                                         window.addEvent('load', function(){
									      (function(){
									                  if(document.id('fb-auth') == null) {
									                  var root = document.createElement('div');
									                  root.id = 'fb-root';
									                  $$('.itemFacebookButton')[0].appendChild(root);
									                  (function(d, s, id) {
									                    var js, fjs = d.getElementsByTagName(s)[0];
									                    if (d.getElementById(id)) {return;}
									                    js = d.createElement(s); js.id = id;
									                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=171342606239806&version=v2.0";
									                    fjs.parentNode.insertBefore(js, fjs);
									                  }(document, 'script', 'facebook-jssdk')); 
									              }
									      }());
									  });
									</script>
<!--                                            <div class="fb-like" data-width="260" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>-->
                                            <div class="fb-share-button" data-width="260"></div>
<!--                                                  <div class="fb-like" data-send="false" data-width="260" data-show-faces="true"> </div>-->
                                        </div>
                                        <?php endif; ?>
                                        <?php if($params->get('itemGooglePlusOneButton',1)): ?>
                                        <div class="itemGooglePlusOneButton">
                                                  <g:plusone annotation="inline" width="120"></g:plusone>
                                                  <script type="text/javascript">
		                          (function() {
		                            window.___gcfg = {lang: 'en'}; // Define button default language here
		                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		                            po.src = 'https://apis.google.com/js/plusone.js';
		                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		                          })();
		                    </script> 
                                        </div>
                                        <?php endif; ?>
                              </div>
                              <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if($params->get('itemVideo') && !empty($this->item->video)): ?>
                    <div class="itemVideoBlock" id="itemVideoAnchor">
                              <h3><?php echo JText::_('K2_MEDIA'); ?></h3>
                              <?php if($this->item->videoType=='embedded'): ?>
                              <div class="itemVideoEmbedded"> <?php echo $this->item->video; ?> </div>
                              <?php else: ?>
                              <span class="itemVideo"><?php echo $this->item->video; ?></span>
                              <?php endif; ?>
                              <?php if($params->get('itemVideoCaption') && !empty($this->item->video_caption)): ?>
                              <span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
                              <?php endif; ?>
                              <?php if($params->get('itemVideoCredits') && !empty($this->item->video_credits)): ?>
                              <span class="itemVideoCredits"><?php echo $this->item->video_credits; ?></span>
                              <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if($params->get('itemImageGallery') && !empty($this->item->gallery)): ?>
                    <div class="itemImageGallery" id="itemImageGalleryAnchor">
                              <h3><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h3>
                              <?php echo $this->item->gallery; ?> </div>
                    <?php endif; ?>

                    <?php echo $this->item->event->AfterDisplay; ?> <?php echo $this->item->event->K2AfterDisplay; ?> </div>
          <?php if($params->get('itemComments') && ( ($params->get('comments') == '2' && !$this->user->guest) || ($params->get('comments') == '1'))):?>
          <?php echo $this->item->event->K2CommentsBlock; ?>
          <?php endif;?>
          <?php if($params->get('itemComments') && !JRequest::getInt('print') && ($params->get('comments') == '1' || ($params->get('comments') == '2')) && empty($this->item->event->K2CommentsBlock)):?>
          <div class="itemComments" id="itemCommentsAnchor">
                    <?php if($params->get('commentsFormPosition')=='above' && $params->get('itemComments') && !JRequest::getInt('print') && ($params->get('comments') == '1' || ($params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
                    <div class="itemCommentsForm"> <?php echo $this->loadTemplate('comments_form'); ?> </div>
                    <?php endif; ?>
                    <?php if($this->item->numOfComments>0 && $params->get('itemComments') && !JRequest::getInt('print') && ($params->get('comments') == '1' || ($params->get('comments') == '2'))): ?>
                    <h3> <?php echo $this->item->numOfComments; ?> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?> </h3>
                    <ul class="itemCommentsList">
                              <?php foreach ($this->item->comments as $key=>$comment): ?>
                              <li class="<?php echo ($key%2) ? "odd" : "even"; echo (!$this->item->created_by_alias && $comment->userID==$this->item->created_by) ? " authorResponse" : ""; echo($comment->published) ? '':' unpublishedComment'; ?>">
                                        <?php if($comment->userImage):?>
                                        <img src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" width="<?php echo $params->get('commenterImgWidth'); ?>" />
                                        <?php endif; ?>
                                        <div><span>
                                                  <?php if(!empty($comment->userLink)): ?>
                                                  <a href="<?php echo JFilterOutput::cleanText($comment->userLink); ?>" title="<?php echo JFilterOutput::cleanText($comment->userName); ?>" target="_blank" rel="nofollow"> <?php echo $comment->userName; ?> </a>
                                                  <?php else: ?>
                                                  <?php echo $comment->userName; ?>
                                                  <?php endif; ?>
                                                  </span> <span> <?php echo JHTML::_('date', $comment->commentDate, JText::_('DATE_FORMAT_LC2')); ?> </span> <span> <a class="commentLink" href="<?php echo $this->item->link; ?>#comment<?php echo $comment->id; ?>" name="comment<?php echo $comment->id; ?>" id="comment<?php echo $comment->id; ?>"> <?php echo JText::_('K2_COMMENT_LINK'); ?> </a> </span>
                                                  <p><?php echo $comment->commentText; ?></p>
                                                  <?php if($this->inlineCommentsModeration || ($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest)))): ?>
                                                  <span class="commentToolbar">
                                                  <?php if($this->inlineCommentsModeration): ?>
                                                  <?php if(!$comment->published): ?>
                                                  <a class="commentApproveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=publish&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_APPROVE')?></a>
                                                  <?php endif;?>
                                                  <a class="commentRemoveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=remove&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_REMOVE')?></a>
                                                  <?php endif;?>
                                                  <?php if($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest))): ?>
                                                  <a class="commentReportLink modal" rel="{handler:'iframe',size:{x:640,y:480}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=report&commentID='.$comment->id)?>"><?php echo JText::_('K2_REPORT')?></a>
                                                  <?php endif; ?>
                                                  </span>
                                                  <?php endif; ?>
                                        </div>
                              </li>
                              <?php endforeach; ?>
                    </ul>
                    <div> <?php echo $this->pagination->getPagesLinks(); ?> </div>
                    <?php endif; ?>
                    <?php if($params->get('commentsFormPosition')=='below' && $params->get('itemComments') && !JRequest::getInt('print') && ($params->get('comments') == '1' || ($params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
                    <h3> <?php echo JText::_('K2_LEAVE_A_COMMENT') ?> </h3>
                    <div class="itemCommentsForm"> <?php echo $this->loadTemplate('comments_form'); ?> </div>
                    <?php endif; ?>
                    <?php $user = JFactory::getUser(); if ($params->get('comments') == '2' && $user->guest):?>
                    <div> <?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS');?> </div>
                    <?php endif; ?>
          </div>
          <?php endif; ?>
</article>
