# Agencia de Innovación

## Pre-requisitos
- Tener un backup de la base de datos con junta.mdf y junta.ldf en la carpeta ./data
- Tener docker engine instalado

## Pasos para levantar
- Ejecutar `docker compose up -d`
- Entrar en el contenedor de la base de datos `docker exec -it db-sqlserver /opt/mssql-tools/bin/sqlcmd -U SA -P '"asd123"' -i /var/opt/mssql/backup/usuarios.sql`