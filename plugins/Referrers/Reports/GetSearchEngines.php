<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Referrers\Reports;

use Piwik\Piwik;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\CoreVisualizations\Visualizations\HtmlTable;
use Piwik\Plugins\Referrers\Columns\SearchEngine;

class GetSearchEngines extends Base
{
    protected function init()
    {
        parent::init();
        $this->dimension     = new SearchEngine();
        $this->name          = Piwik::translate('Referrers_SearchEngines');
        $this->documentation = Piwik::translate('Referrers_SearchEnginesReportDocumentation', '<br />');
        $this->actionToLoadSubTables = 'getKeywordsFromSearchEngineId';
        $this->order = 7;
        $this->widgetTitle  = 'Referrers_SearchEngines';
    }

    public function configureView(ViewDataTable $view)
    {
        $view->config->subtable_controller_action  = 'getKeywordsFromSearchEngineId';
        $view->config->show_exclude_low_population = false;
        $view->config->show_search = false;
        $view->config->show_goals  = true;
        $view->config->addTranslation('label', $this->dimension->getName());

        $view->requestConfig->filter_limit = 25;

        if ($view->isViewDataTableId(HtmlTable::ID)) {
            $view->config->disable_subtable_when_show_goals = true;
        }
    }

}
