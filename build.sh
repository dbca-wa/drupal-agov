#!/bin/bash
APP_DIR=drupal
drush dl drupal-8.x.x
rm -rf $APP_DIR; mv -v drupal-8* $APP_DIR
pushd $APP_DIR
# Install drupal modules
drush dl admin_toolbar agov_base agov_whitlam better_normalizers ctools default_content ds embed 
drush dl entity entity_browser entity_embed fences inline_entity_form link_attributes linkit linky 
drush dl media_entity media_entity_browser media_entity_image metatag page_manager panels password_policy 
drush dl pathauto pnx_media pnx_media_embed scheduled_updates simple_sitemap token twitter_block 
drush dl video_embed_field workbench_moderation
popd
rsync -v src/ $APP_DIR/

