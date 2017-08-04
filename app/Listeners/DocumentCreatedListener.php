<?php

namespace App\Listeners;

use App\Events\DocumentCreated;
use App\Repositories\OperationLogs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DocumentCreated $event
     *
     * @return void
     */
    public function handle(DocumentCreated $event)
    {
        $doc = $event->getDocument();

        OperationLogs::log(\Auth::user()->id,
            __(
                'log.user_create_document',
                [
                    'username'     => $doc->user->name,
                    'user_id'      => $doc->user_id,
                    'project_name' => $doc->project->name,
                    'project_id'   => $doc->project_id,
                    'doc_title'    => $doc->title,
                    'doc_id'       => $doc->id
                ]
            )
        );
    }
}