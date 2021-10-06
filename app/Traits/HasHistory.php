<?php

namespace App\Traits;

trait HasHistory
{
    /**
     * Add a history entry
     */
    public function addHistory(string $message, bool $author = true, string $notes = null)
    {
        $history = json_decode($this->history);

        $stamp = [
            'user_id' => auth()->user() ? auth()->user()->id : '-',
            'user_name' => auth()->user() ? $this->getGuardName() : '-',
            'status' => $this->status,
            'date' => now()->toDateTimeString(),
            'message' => $author ? $message . ' oleh ' . (auth()->user() ? $this->getGuardName() : '-') : $message,
        ];

        if ($notes) {
            $stamp['notes'] = $notes;
        }

        $history[] = $stamp;

        $this->history = json_encode($history);

        return $this;
    }

    /**
     * Set status attribute
     */
    public function setStatus(string $status, string $action, string $timestampColumn = null)
    {
        $this->status = $status;
        $this->addHistory($action);
        if ($timestampColumn) {
            $this->{$timestampColumn} = now()->toDateTimeString();
        }
    }

    /**
     * Return guard name attribute
     */
    private function getGuardName()
    {
        return auth()->user()->fullname;
    }
}