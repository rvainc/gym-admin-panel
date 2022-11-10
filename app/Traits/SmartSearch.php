<?php

namespace App\Traits;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait SmartSearch
{
    /**
     * @param Builder $builder
     * @param array $fields
     * @param string $text
     * @return Builder
     */
    protected function addSmartSearchConstraints($builder, $fields, $text)
    {
        if (empty($text)) {
            return $builder;
        }

        $subject = Str::of($text)
            ->trim()
            ->replaceMatches('/\s+/', ' ')
            ->explode(' ')
            ->filter(function ($value) {
                return filled($value);
            });

        return $builder->where(function ($query) use ($fields, $subject) {
            foreach ($subject as $part) {
                $query->where(function ($query) use ($fields, $part) {
                    foreach ($fields as $key => $field) {
                        if (is_numeric($key)) {
                            $this->addGenericSmartSearchConstraint($query, $field, $part);
                        } elseif (is_string($key) && is_array($field)) {
                            $this->addArraySmartSearchConstraint($query, $key, $field, $part);
                        } elseif (is_string($key) && $field instanceof Closure) {
                            $this->addClosureSmartSearchConstraint($query, $key, $field, $part);
                        }
                    }
                });
            }
        });
    }

    /**
     * @param Builder $builder
     * @param string $field
     * @param string $value
     */
    protected function addGenericSmartSearchConstraint($builder, $field, $value)
    {
        $builder->orWhereRaw(...$this->smartSearchWhereBuilder($field, $value));
    }

    /**
     * @param Builder $builder
     * @param string $relation
     * @param array $fields
     * @param string $value
     */
    protected function addArraySmartSearchConstraint($builder, $relation, array $fields, $value)
    {
        $builder->has(
            $relation,
            '>=',
            1,
            'or',
            function ($builder) use ($fields, $value) {
                $builder->where(function ($builder) use ($fields, $value) {
                    foreach ($fields as $field) {
                        $builder->orWhereRaw(...$this->smartSearchWhereBuilder($field, $value));
                    }
                });
            }
        );
    }

    /**
     * @param Builder $builder
     * @param string $field
     * @param Closure $callback
     * @param string $value
     */
    protected function addClosureSmartSearchConstraint($builder, $field, $callback, $value)
    {
        $builder->tap(function ($builder) use ($field, $callback, $value) {
            $callback($builder, $field, $value);
        });
    }

    /**
     * @param string $field
     * @param string $value
     * @return array
     */
    protected function smartSearchWhereBuilder($field, $value)
    {
        return [
            $field.'::TEXT ILIKE ?',
            ['%'.$value.'%'],
        ];
    }
}
