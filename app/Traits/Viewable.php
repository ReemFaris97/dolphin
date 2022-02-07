<?php

namespace App\Traits;

use Illuminate\Support\Facades\View;

/**
 * Trait Viewable
 * @description Simplifies model's views routing.
 * @package App\Support\Traits
 */
trait Viewable
{
    /**
     * Redirect to index view.
     *
     * @param array $with
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function toIndex(array $with = [])
    {
        return view("{$this->viewable}index", $with);
    }

    /**
     * Redirect to create view.
     *
     * @param array $with
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function toCreate(array $with = [])
    {
        return view("{$this->viewable}create", $with);
    }
    /**
     * Redirect to show view.
     *
     * @param array $with
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    private function toShow(array $with = [])
    {
        return view("{$this->viewable}show", $with);
    }

    /**
     * Redirect to edit view.
     *
     * @param array $with
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function toEdit(array $with = [])
    {
        return view("{$this->viewable}edit", $with);
    }
}
