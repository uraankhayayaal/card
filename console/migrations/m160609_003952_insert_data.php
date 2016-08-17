<?php

use yii\db\Migration;

class m160609_003952_insert_data extends Migration
{
    public function up()
    {
        $this->insert('{{company}}', ['id'=>1,   'name'=>'Кружало', 'content' => 'Ресторан русской и якутской кухни, банкетные залы на 80 и 300 мест']);
        $this->insert('{{company}}', ['id'=>2,   'name'=>'Богатырь', 'content' => 'Магазин спецодежды для охоты и рыболки а так же снасти и палатки']);
        $this->insert('{{company}}', ['id'=>3,   'name'=>'Парк культуры и отдыха', 'content' => 'Городской центральный парк, атракционы, концерты и развлечения']);
        $this->insert('{{company}}', ['id'=>4,   'name'=>'Техник', 'content' => 'Магазин компьютерной техники и их комплетующих']);
        $this->insert('{{company}}', ['id'=>5,   'name'=>'Boston', 'content' => 'Одежда и обувь, американского производства']);

        $this->insert('{{card}}', ['id'=>1,   'name'=>'Кружало', 'company_id' => 1, 'path' => 'http://card.dty.su/img/krujalo.jpg']);
        $this->insert('{{card}}', ['id'=>2,   'name'=>'Богатырь', 'company_id' => 2, 'path' => 'http://card.dty.su/img/bogatir.jpg']);
        $this->insert('{{card}}', ['id'=>3,   'name'=>'Центральный парк', 'company_id' => 3, 'path' => 'http://card.dty.su/img/park.jpg']);
        $this->insert('{{card}}', ['id'=>4,   'name'=>'Техник', 'company_id' => 4, 'path' => 'http://card.dty.su/img/technik.jpg']);
        $this->insert('{{card}}', ['id'=>5,   'name'=>'Boston premium', 'company_id' => 5, 'path' => 'http://card.dty.su/img/boston.jpg']);
        $this->insert('{{card}}', ['id'=>6,   'name'=>'Boston gold', 'company_id' => 5, 'path' => 'http://card.dty.su/img/boston_gold.jpg']);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company');
    }
}
