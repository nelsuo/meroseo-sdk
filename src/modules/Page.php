<?php 

namespace Meroseo\Sdk\Modules;

class Page extends Generic
{

    /**
     * Although I want to get pages info by reading a sitemap
     * and scrapping the website. For reaching the first goals and creating
     * a MVP, I will be creating the pages using an api.
     */
    public function create($data) {
        return $this->post('/page/create/', [
            'data' => $data
        ]);
    }

    /**
     * When a page gets updated, the system must be notified, so it 
     * can show information on the event, and also to be able to track fluctuations
     * based on that update.
     */
    public function update($pageId, $data) {
        return $this->post('/page/update/', [
            'pageId' => $pageId,
            'data' => $data
        ]);
    }

    /**
     * This allows to show notes for certain articles, like:
     *      - it was used on facebook.
     *      - it was trending in the news.
     */
    public function notifyEvent($pageId, $data) {

        return $this->post('/page/notify-event/', [
            'pageId' => $pageId,
            'data' => $data
        ]);

        $this->jsonResponse(true, []);
    }

    public function delete($pageId) {

        return $this->post('/page/delete/', [
            'pageId' => $pageId
        ]);

    }    

}
