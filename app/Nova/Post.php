<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Panel;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    public static $group = 'Artigos';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Post';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'body'
    ];

    public static function label()
    {
        return __('Posts');
    }

    // public static function singularLabel()
    // {
    //     return __('Postx');
    // }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            new Panel('Conteúdo', [
                Text::make(__('Title'), 'title')
                    ->rules('required', 'max:100',  function ($attribute, $value, $fail) {
                        if ($value == 'e') {
                            return $fail('O campo ' . $attribute . ' recebeu o valor ' . $value . ' que é inválido');
                        }
                    })
                    ->help('Pense em um título chamativo e com apelo para SEO'),
                Trix::make(__('Body'), 'body')
                    ->rules('required'),
            ]),
            BelongsTo::make(__('Users'), 'author', User::class),
            BelongsToMany::make(__('Categories'), 'categories', Category::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
