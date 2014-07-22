
<div id="rightmenu" class="column">
    <div class="lm_bl"></div>
    <div class="lm_md lm_ctot">
        <div id="lm_cldh">
            <span >Informations</span>
        </div>
        <div class="lm_bl"></div>

        <div class="lm_h lm_hcu">
            <a href="#" title="Afficher le contenu de ce menu"onClick="show('lm_navig_cat');"> &dArr;</a>
            <a href="#">Joueur</a>
            <a href="#" title="Cacher le contenu de ce menu" onClick="hide('lm_navig_cat');">&uArr;</a>
        </div>
        <div id="lm_navig_cat" class="lm_hs">
            <div class="lm_smcu">Nom : <?= $user['username'];?></div>
            <div class="lm_smcu">Points : <?= $user['rank_pts'];?></div>
            <div class="lm_smcu">Classement : <?= $user['rank_pts_pos'];?></div>
            <br>
        </div>

        <div class="lm_h lm_hcu">
            <a href="#" title="Afficher le contenu de ce menu"onClick="show('lm_navig_cat');"> &dArr;</a>
            <a href="#">Alliance</a>
            <a href="#" title="Cacher le contenu de ce menu" onClick="hide('lm_navig_cat');">&uArr;</a>
        </div>
        <div id="lm_navig_cat" class="lm_hs">
            <?php if (isset($user['team_id'])):?>
            <div class="lm_smcu">Nom : *</div>
            <div class="lm_smcu">Points : *</div>
            <div class="lm_smcu">Classement : *</div>
            <?php else:?>
            <div class="lm_smcu">Chercher</div>
            <div class="lm_smcu">Fonder</div>
            <?php endif;?>
            <br>
        </div>

        <div class="lm_h lm_hcu">
            <a href="#" title="Afficher le contenu de ce menu"onClick="show('lm_navig_cat');"> &dArr;</a>
            <a href="#">Ville</a>
            <a href="#" title="Cacher le contenu de ce menu" onClick="hide('lm_navig_cat');">&uArr;</a>
        </div>
        <div id="lm_navig_cat" class="lm_hs">
            <div class="lm_smcu">Nom : <?= $camp['name'];?></div>
            <div class="lm_smcu">Cases : <?= $camp['boxes'].' / '.$camp['maxBoxes'];?></div>
            <div class="lm_smcu">
                <div class="default_1c1">
                    <div class="default_1c1a curvedtot"><div class="default_head_img dhi5" title="M&eacute;tal"></div></div>
                    <div class="default_1c1b" style="overflow:visible;" id="ov_metal">
                        <a href="#" title="2.780290261E+11"><font color="#7BE654"><?= floor($camp['res1']);?></font></a>
                    </div>
                </div>
            </div>
            <div class="lm_smcu">
                <div class="default_1c2">
                    <div class="default_1c1a curvedtot"><div class="default_head_img dhi3" title="Silicium"></div></div>
                    <div class="default_1c1b" style="overflow:auto;" id="ov_cristal">
                        <a href="#" title="6.544852447E+10"><font color="#7BE654"><?= floor($camp['res2']);?></font></a>
                    </div>
                </div>
            </div>
            <div class="lm_smcu">
                <div class="default_1c3">
                    <div class="default_1c1a curvedtot"><div class="default_head_img dhi1" title="Uranium"></div></div>
                    <div class="default_1c1b" style="overflow:auto;" id="ov_deuterium">
                        <a href="#" title="3.968553836E+10"><font color="#7BE654"><?= floor($camp['res3']);?></font></a>
                    </div>
                </div>
            </div>
            <div class="lm_smcu">
                <div class="default_1b1 curvedtot">
                    <form action="" method="get" id="changeplanet" name="changeplanet">
                        <input type="hidden" value="2ea6de2c800468356ac80ca48aed3afa" name="token">
                        <select name="cp" id="cp" size="1" onchange="javascript:document.forms[0].submit();">
                            <?php foreach ($camps as $c):
                                $c = current($c);
                                $selected = ($camp['id'] === $c['id'] ? 'selected' : 'no');?>
                            <option value="3201"
                                    style="font-weight:bold;"
                                    selected="<?=$selected;?>"><?= $c['name'];?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="hidden" name="re" value="0">
                    </form>
                </div>
            </div>
        </div>
        <br>

        <div class="lm_h lm_hcu">
            <a href="#" title="Afficher le contenu de ce menu"onClick="show('lm_navig_cat');"> &dArr;</a>
            <a href="#">Armée</a>
            <a href="#" title="Cacher le contenu de ce menu" onClick="hide('lm_navig_cat');">&uArr;</a>
        </div>
        <div id="lm_navig_cat" class="lm_hs">
            <div class="lm_smcu">Scout : *</div>
            <div class="lm_smcu">Medic : *</div>
            <div class="lm_smcu">Recon : *</div>
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

    </div>
<br>

</div>