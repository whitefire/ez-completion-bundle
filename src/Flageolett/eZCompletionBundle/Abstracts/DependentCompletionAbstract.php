<?php
/**
 * @author Henning Kvinnesland <henning@keyteq.no>
 * @since 21.12.14
 */

namespace Flageolett\eZCompletionBundle\Abstracts;

use Flageolett\eZCompletionBundle\Entity\DependentCompletionContainer;

abstract class DependentCompletionAbstract extends CompletionAbstract
{
    protected function buildCompletionContainers($configs, $source)
    {
        $containers = array();
        foreach ($configs as $config) {
            foreach ($source as $dependence => $dataSource) {
                $completions = $this->buildCompletions($config, $dataSource);
                $parameterIndex = isset($config['parameterIndex']) ? $config['parameterIndex'] : 0;
                $completionContainer = new DependentCompletionContainer($config['method'], $parameterIndex, $completions);
                $completionContainer->setDependence($dependence);
                $containers[] = $completionContainer;
            }
        }

        return $containers;
    }

}
