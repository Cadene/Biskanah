<?php

namespace logout {
    function update_server_ressources($user_id)
    {
        $sql = 'SELECT prod1,prod2,prod3,res1,res2,res3 FROM camps WHERE user_id='.$user_id;
        $results = mysql_query($sql);
        while($result = mysql_fetch_assoc($results))
        {
            foreach($result as $key => $value)
            {
                $result[$key] = ($value + 1);
                // TODO remplacer 1 par le calcul de la nouvelle valeur de resX =((time()-last_update)*prodX)
            }
            var_dump($result);
        }
    }
}

namespace beforeAction {
    function update_server_ressources($camp_id)
    {
        $sql = 'SELECT prod1,prod2,prod3,res1,res2,res3 FROM camps WHERE id='.$camp_id;

        $result = mysql_query($sql);
        $result = mysql_fetch_assoc($result);
        foreach($result as $key => $value)
        {
            $result[$key] = ($value + 1);
            // TODO remplacer 1 par le calcul de la nouvelle valeur de resX =((time()-last_update)*prodX)
        }
        var_dump($result);
    }
}

namespace {

    mysql_connect("localhost","root","enaifos");
    mysql_select_db("biskanahv1");


beforeAction\update_server_ressources(3);

function A2Bs_notification($id)
{
    $sql = 'SELECT id,finish FROM A2Bs WHERE finish >= NOW()';
    // TODO remplacer accepted par arrivée (ou laisser accepted si elle n'est pas utilisée
    $results = mysql_query($sql);
    while( $result = mysql_fetch_assoc($results))
    {
        if($result['finish'] >= time())
            sqlite_query('UPDATE A2Bs SET accepted=1 WHERE id='.$result['id']);
    }
    // TODO affecter l'unité au camps.id = a2bs.to

}

function Dtbuilding_notification()
{
    $sql = 'SELECT id,finish FROM Dtbuildings';// TODO ajouter la comparaison avec NOW()
    $results = mysql_query($sql);
    while( $result = mysql_fetch_assoc($results))
    {
        if($result['finish'] >= time())
        {
            $lvl = $result['id']+1;
            mysql_query('UPDATE Buildings SET databuilding_id='.$lvl.'WHERE id='.$result['building_id']);
            // TODO avant le DELETE ,MAJ le log
            mysql_query('DELETE FROM Dtbuildings WHERE id='.$result['id']);
        }
    }
}

function Dttechno_notification($id)
{
    $sql = 'SELECT id,finish FROM Dttechnos';// TODO ajouter la comparaison avec NOW()
    $results = mysql_query($sql);
    while( $result = mysql_fetch_assoc($results))
    {
        if($result['finish'] >= time())
        {
            $lvl = $result['id']+1;
            mysql_query('UPDATE Technos SET datatechno_id='.$lvl.'WHERE id='.$result['techno_id']);
            // TODO avant le DELETE ,MAJ le log
            mysql_query('DELETE FROM Dttechnos WHERE id='.$result['id']);
        }
    }
}

function update_user_rank($id)
{
    // TODO update user rank
}

function update_team_rank($id)
{
    // TODO update team rank
}

}
?>