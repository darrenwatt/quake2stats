<?php
/**
 * This file is part of GameQ.
 *
 * GameQ is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * GameQ is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * $Id: teeworlds.php,v 1.1 2008/06/30 22:31:28 tombuskens Exp $  
 */
 
 
require_once GAMEQ_BASE . 'Protocol.php';


/**
 * Teeworlds protocol
 *
 * @author         Tom Buskens <t.buskens@deviation.nl>
 * @version        $Revision: 1.1 $
 */
class GameQ_Protocol_teeworlds extends GameQ_Protocol
{
    /*
     * status packet
     */
    public function status()
    {
        $this->p->skip(14);

        $this->r->add('version',  $this->p->readString());
        $this->r->add('hostname', $this->p->readString());
        $this->r->add('map',      $this->p->readString());

        switch ($this->p->readString()) {
            case '0': $gt = 'dm';  break;
            case '1': $gt = 'tdm'; break;
            case '2': $gt = 'ctf'; break;
            default:  $gt = 'unknown'; break;
        }
        $this->r->add('gametype',    $gt);
        $this->r->add('password',    $this->p->readString());
        $this->r->add('ping',        $this->p->readString());
        $this->r->add('num_players', $this->p->readString());
        $this->r->add('max_players', $this->p->readString());

        $this->players();
    }

    private function players()
    {
        while ($name = $this->p->readString()) {
            $this->r->addPlayer('name',  $name);
            $this->r->addPlayer('score', $this->p->readString());
        }
    }
}
?>
