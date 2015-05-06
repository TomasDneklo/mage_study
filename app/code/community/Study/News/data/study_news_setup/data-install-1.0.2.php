<?php
/**
 * News data installation script
 */

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;

/**
 * @var $model Study_News_Model_News
 */
$model = Mage::getModel('study_news/news');

// Set up data rows
$dataRows = array(
    array(
        'title'         => 'Magento Developer Certificate Exams Now Available Worldwide',
        'author'        => 'Beth Gomez',
        'published_at'  => '2011-12-22',
        'content'       => 'Lorem ipsum dolor sit amet, id causae voluptua oporteat eum. Molestie appareat eum ut, libris melius in usu. Sit ex harum nominati complectitur. Ea esse natum choro qui, mutat putant facilisi vix ex. Illud partem salutandi his ex.
            Nonumes facilisis assueverit te per, mea id primis vidisse inermis. Ius te interpretaris concludaturque. Enim facer mucius eum ad, eu discere postulant honestatis duo. Blandit gubergren an sed. Vis ea clita electram mnesarchum.
            Id ius aperiri principes hendrerit. Amet vidisse copiosae ad nec, quod inani everti vix in. Per quando oblique sensibus id, ut usu utamur imperdiet. Everti reprehendunt cu eos.'
    ),

    array(
        'title'         => 'Introducting Magento Enterprise Premium',
        'author'        => 'Pedram Yasharel',
        'published_at'  => '2011-11-23',
        'content'       => 'Ad vis tota vocibus, invidunt referrentur sed no, doctus recteque torquatos ex mel. Vidit debet aperiri usu id, pro commodo debitis maiorum te. Vel noster fierent et, his ignota appellantur te. Sit id augue sensibus, sit mollis aliquid tacimates an. Liber omnesque principes sea et, nonumy menandri sententiae id eum, no omnium vocibus pertinax vel.
            Velit putant concludaturque ex sit, et atqui iriure nec, an eos error vulputate interesset. Ex qui nulla quidam verterem. Mei ut prompta pertinacia, eos an eros dissentias. Qui iudico expetendis posidonium ea. Et veniam expetenda definiebas qui, sint primis quo ea. Sit in case integre omnesque, ne adhuc delicata imperdiet vix.'
    ),

    array(
        'title'         => 'Magento Supports Facebook Open Graph 2.01',
        'author'        => 'Baruch Toledano',
        'published_at'  => '2011-10-18',
        'content'       => ' Enim lucilius erroribus his an, tritani intellegam vim cu. Ut partem admodum liberavisse pri, vis ut dicta facilisi. No sea habeo omnium, ut erat augue graecis vis. Sed an quod veniam omittam, te sed vitae graeco nonumes. Esse unum graece in eam, minim interpretaris in duo. Vix tacimates adolescens ne. Ut eos stet ridens quaeque, vim an elit vidit, ea nullam consetetur percipitur nam.
            Congue vidisse praesent te mel, qui probo semper an. Erant mucius pri ut. Scripta utroque scriptorem ius cu. Persius posidonium at vim. Id vim tale cibo quaeque, at qui ridens postea accusata.
            Dicit docendi minimum ut vim. Dicta invidunt invenire id mel. Cu cum sale assentior, at qui sint oporteat interesset. An veritus dolores vituperata quo, no tantas causae partiendo ius. Ex nonumy ornatus voluptatibus qui, imperdiet voluptatum pri et. Vim et habemus probatus.'
    ),
);

foreach($dataRows as $data){
    $model->setData($data)->setOrigData()->save();
}
