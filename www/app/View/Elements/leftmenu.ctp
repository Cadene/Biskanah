<div id="leftmenu" class="column">

    <div class="lm_bl"></div>
<div class="lm_md lm_ctot">
    <div id="lm_cldh">
        <span id="lm_dh" class="lm_ctot"
              title="Attention, cette heure n'est pas l'heure du serveur, mais l'heure de votre ordinateur">
        </span> - <span id="lm_cl">
            <a href="<?= $this->Html->url(['controller'=>'pages','action' => 'view','changelog']);?>"
               id="lm_cla" title="Changelog mis &agrave; jour le : 00/00/2014 00:00:00">Changelog</a>
        </span>
    </div>
    <!--
    <div class="lm_mes lm_hcu">
        <a href="<?= $this->Html->url(['controller'=>'messages','action' => 'kind','1']);?>" title="Afficher la page : Messages"
           onClick="show('lm_message_cat');">Messages <span  style="color:red;">(3)</span></a>
    </div>
    <div id="lm_mesc">
        <div><a href="<?= $this->Html->url(['controller'=>'messages','action' => 'kind','1']);?>"
                title="Raccourci vers la sous cat&eacute;gorie : Espionnage" id="lm_mess0" >Espionnage</a>
        </div>
        <div><a href="<?= $this->Html->url(['controller'=>'messages','action' => 'kind','1']);?>"
                title="Raccourci vers la sous cat&eacute;gorie : Combat" id="lm_mess3" >Combat</a>
        </div>
        <div><a href="<?= $this->Html->url(['controller'=>'messages','action' => 'kind','1']);?>"
                title="Raccourci vers la sous cat&eacute;gorie : Alliance" id="lm_mess2" >Alliance</a>
        </div>
        <div><a href="<?= $this->Html->url(['controller'=>'messages','action' => 'kind','1']);?>"
                title="Raccourci vers la sous cat&eacute;gorie : Joueur" id="lm_mess1" >Joueur</a>
        </div>
        <div><a href="<?= $this->Html->url(['controller'=>'messages','action' => 'kind','1']);?>"
                title="Raccourci vers la sous cat&eacute;gorie : Exploitation" id="lm_mess4" >Exploitation</a>
        </div>
        <div><a href="<?= $this->Html->url(['controller'=>'messages','action' => 'kind','1']);?>"
                title="Raccourci vers la sous cat&eacute;gorie : Transport" id="lm_mess5" >Transport</a>
        </div>
    </div>
    <div id="lm_chm"
         title="Afficher/Cacher les raccourcis vers les diff&eacute;rents types de messages">
        &dArr; <a href="#" onClick="show('lm_mesc');change('lm_chm',true);" id="lm_chma">Cat&eacute;gories</a> &dArr;
    </div>-->
    <div class="lm_bl"></div>
    <div class="lm_h lm_hcu">
        <a href="#" title="Afficher le contenu de ce menu"onClick="show('lm_navig_cat');"> &dArr;</a>
            Navigation
        <a href="#" title="Cacher le contenu de ce menu" onClick="hide('lm_navig_cat');">&uArr;</a>
    </div>
    <div id="lm_navig_cat" class="lm_hs">
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'users','action' => 'news']);?>"
               title="Afficher la page : Vue g&eacute;n&eacute;rale" >
                    Page d'accueil
            </a>
        </div>
        <div class="lm_smcu"><?=$this->Html->link('Bâtiments','/buildings/index');?></div>
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'worlds','action' => 'view']);?>" title="Afficher la map" >Map</a>
        </div>
        <div class="lm_smcu">
            <a href="" title="Afficher la page : Flotte" >Armée</a>
        </div>
        <div class="lm_smcu">
            <a href="" title="Afficher la page : Empire" >Empire</a>
        </div>
    </div>
    <br>
    <div class="lm_h lm_hcu">
        <a href="#" title="Afficher le contenu de ce menu"onClick="show('lm_build_cat');">&dArr;</a>
            Raccourcis
        <a href="#" title="Cacher le contenu de ce menu" onClick="hide('lm_build_cat');">&uArr;</a>
    </div>
    <div id="lm_build_cat" class="lm_hs">
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'buildings','action' => 'display',11]);?>" title="Afficher la page : Laboratoire" >Laboratoire</a>
        </div>
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'buildings','action' => 'display',12]);?>" title="Afficher la page : Armurerie" >Armurerie</a>
        </div>
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'buildings','action' => 'display',7]);?>" title="Afficher la page : Caserne" >Caserne</a>
        </div>
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'buildings','action' => 'display',8]);?>" title="Afficher la page : Factory" >Factory</a>
        </div>
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'buildings','action' => 'display',9]);?>" title="Afficher la page : Base Aérienne" >Base Aérienne</a>
        </div>
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'buildings','action' => 'display',13]);?>" title="Afficher la page : Téléporteur" >Téléporteur</a>
        </div>
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'buildings','action' => 'display',14]);?>" title="Afficher la page : Relais Marchand" >Relais Marchand</a>
        </div>
    </div>
    <br>
    <div class="lm_h lm_hcu">
        <a href="#" title="Afficher le contenu de ce menu" onClick="show('lm_outil_cat');">&dArr;</a>
            Outils
        <a href="#" title="Cacher le contenu de ce menu" onClick="hide('lm_outil_cat');">&uArr;</a>
    </div>
    <div id="lm_outil_cat" class="lm_hs">
        <div class="lm_smcu">
            <a href="<?= $this->Html->url(['controller'=>'rankusers','action' => 'index']);?>" title="Afficher la page : Classements" >Classements</a>
        </div>
        <div class="lm_smcu">
            <a href="" title="Afficher la page : Records" >Records</a>
        </div>
        <div class="lm_smcu">
            <a href="" title="Afficher la page : Simulateur" >Simulateur</a>
        </div>
        <div class="lm_smcu">
            <a href="" title="Afficher la page : Production" >Production</a>
        </div>
        <div class="lm_smcu">
            <a href="" title="Afficher la page : Arbre Technologique" >Arbre Technologique</a>
        </div>
    </div>
    <br>
    <br>
    <div class="lm_lt lm_ctot">
        <a href="<?=$this->Html->url('/users/logout');?>" target="_top"
           title="En cliquant sur ce lien, vous serez d&eacute;connect&eacute;">D&eacute;connexion</a>
    </div>
    <br>
    <!--
    <div class="lm_lang">
        <div class="lm_lang_img">
            <a href="frames.php?lang_change=en" target="_parent"title="Put the game in English">
                <img src="http://static.spaceswars.com/fichiers.1.2/images/uk.jpg">
            </a>
        </div>
        <div class="lm_lang_img">
            <a href="frames.php?lang_change=fr" target="_parent" title="Mettre le jeu en Fran&ccedil;ais">
                <img src="http://static.spaceswars.com/fichiers.1.2/images/dr.jpg">
            </a>
        </div>
    </div>
    -->
    <br>

</div>
<br>

</div>