-- #!sqlite
-- #{ AdminMenu
-- #{ players
-- #{ init
CREATE TABLE IF NOT EXISTS players(
player_name VARCHAR(36) PRIMARY KEY,
ban_types   TEXT,
ban_count   INTEGER,
ipban_count INTEGER,
warnings    INTEGER,
reports     TEXT,
mutes       INTEGER,
kicks       INTEGER,
address     TEXT
);
-- #}
-- #{ create
-- #    :player_name string
-- #    :ban_types string
-- #    :ban_count int
-- #    :ipban_count int
-- #    :warnings int
-- #    :reports string
-- #    :mutes int
-- #    :kicks int
-- #    :address string
INSERT INTO players(player_name, ban_types, ban_count, ipban_count, warnings, reports, mutes, kicks, address)
VALUES(:player_name, :ban_types, :ban_count, :ipban_count, :warnings, :reports, :mutes, :kicks, :address)
-- #}
-- #{ update
-- #    :player_name string
-- #    :ban_types string
-- #    :ban_count int
-- #    :ipban_count int
-- #    :warnings int
-- #    :reports string
-- #    :mutes int
-- #    :kicks int
-- #    :address string
UPDATE players
SET
ban_types=:ban_types,
ban_count=:ban_count,
ipban_count=:ipban_count,
warnings=:warnings,
reports=:reports,
mutes=:mutes,
kicks=:kicks,
address=:address
WHERE player_name =: player_name
-- #}
-- #{ load
SELECT * FROM players
-- #}
-- #}
-- #{ bans
-- #{ init
CREATE TABLE if NOT EXISTS bans(
player_name VARCHAR(36),
reason      TEXT,
admin       TEXT,
ban_type    INTEGER,
duration    INTEGER
);
-- #}
-- #{ create
-- #    :player_name string
-- #    :reason string
-- #    :admin string
-- #    :ban_type int
-- #    :duration int
INSERT INTO bans(player_name, reason, admin)
VALUES(:player_name, :reason, :admin)
-- #}
-- #{ load
SELECT * FROM bans
-- #}
-- #{ update
-- #    :player_name string
-- #    :reason string
-- #    :admin string
-- #    :ban_type int
-- #    :duration int
UPDATE bans
SET
reason=:reason,
admin=:admin,
ban_type=:ban_type,
duration=:duration
WHERE player_name = :player_name
-- #}
-- #{ delete
-- #    :player_name string
DELETE bans
WHERE player_name=:player_name
-- #}