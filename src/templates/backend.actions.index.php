<?php
/**
 * Backend {{ moduleName }} {{ action }} action
 */
{% if action in ['index', 'add', 'edit', 'delete'] %}
class Backend{{ moduleName|capitalize }}{{ action|capitalize }} extends BackendBaseAction{{ action|capitalize }}
{% else %}
class Backend{{ moduleName|capitalize }}{{ action|capitalize }} extends BackendBaseAction
{% endif %}
{
    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        parent::execute();

{% if action in ['edit', 'delete'] %}
        $this->id = $this->getParameter('id', 'int');
{% endif %}

{% if action == 'index' %}
        $this->loadDataGrids();
{% elseif action in ['add', 'edit'] %}
        $this->loadForm();
        $this->validateForm();
{% endif %}
        $this->parse();
        $this->display();
    }


{% if action == 'index' %}
    /**
     * Loads the datagrids
     *
     * @return void
     */
    protected function loadDataGrids()
    {
        $this->dataGrid = new BackendDataGridDB();
    }
{% elseif action in ['add', 'edit'] %}
    /**
     * Load form
     *
     * @return void
     */
    protected function loadForm()
    {
        // Create the form
        $this->frm = new BackendForm('{{ action }}');

        // Add fields
    }


    /**
     * Validate form
     *
     * @return void
     */
    protected function validateForm()
    {
        // Submitted?
        if ($this->frm->isSubmitted()) {
            // Check fields

            // Correct?
            if ($this->frm->isCorrect()) {
                // Build item

                // Save

                // Redirect
                $this->redirect(BackendModel::createURLForAction('index') . '&report={{ action }}ed');
            }
        }
    }
{% endif %}


{% if action != 'delete' %}
    /**
     * Parse method
     *
     * @return void
     */
    protected function parse()
    {
        parent::parse();
{% if action == 'index' %}
        $this->tpl->assign('dataGrid', ($this->dataGrid->getNumResults() != 0) ? $this->dataGrid->getContent() : false);
{% endif %}
    }
{% endif %}
}
