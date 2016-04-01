<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2/3/15
 * Time: 11:12 AM
 */

namespace Frontend\Controller;


class Post extends FrontendBase {
    public function executeDefault() {
        return $this->executeDetail();
    }

    public function executeDetail() {
        $id = $this->request()->get('id');
        if(!($post = \Posts::retrieveById($this->request()->get('id')))) {
            $this->raise404("Không tìm thấy bài viết với id: {$id}");
        }

        $post->setHits($post->getHits() + 1);
        $post->save(false);

        $term = \Terms::retrieveById($post->getTermId());
        if (($viewProp = $term->getProperty('post_view'))
            && $this->view()->checkViewFileExist($this->getTemplatePath() .'/Controller/Post/'.$this->_path .$viewProp->getPropertyValue())) {
            $this->setView('Post/' .$viewProp->getPropertyValue());
        } else {
            $this->setView('Post/default');
        }

        //Lấy danh sách các bài viết khác
        $limit = 8;
        $query = \Posts::select();
        $query->andWhere(" `status` = 'PUBLISH' ");
        $query->andWhere(" `is_draft` = 0 ");
        $query->andWhere(" `term_id` = {$term->getId()} ");
        $query->andWhere(" `id` != {$post->getId()} ");
        $query->orderBy('created_time', 'DESC');
        if($limit){
            $query->setMaxResults($limit);
        }

        $news_other = $query->execute();
        $total_news_other = (int)$query->count("id")->execute();

        //Root of category
        $term = \Terms::retrieveById($post->getTermId());
        $root = [];
        foreach($term->getSiteRoot() as $te){
            if( $te instanceof \Terms ) {
                $root[] = $te->toArray();
            }
        }

        $this->view()->assign([
            'post' => $post,
            'term' => $term,
            'news_other' => $news_other,
            'root' => $root,
            'total_news_other' => $total_news_other
        ]);

        return $this->renderComponent();
    }
}