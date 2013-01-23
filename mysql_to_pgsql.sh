# mysqldump -uroot -pmimosa attendance --compatible=postgresql --skip-add-locks >/tmp/att && rsync /tmp/att orion:/tmp/
# mysqldump -uroot -pmimosa attendance --compatible=postgresql --skip-add-locks -t employees >/tmp/att-emp && rsync /tmp/att-emp orion:/tmp/

echo "drop database attendance; drop role attendance; create role attendance login; create database attendance owner attendance;" | psql

psql -U attendance </home/radek/asterix/attendance/create.sql

# employees
#cat /tmp/att-emp | grep INSERT | sed "s/0,0)/false,false)/g" | sed "s/1,1)/true,true)/g" | sed "s/1,0)/true,false)/g" | psql -U attendance
cat /tmp/att | grep INSERT | grep employees | psql -U attendance

cat /tmp/att | grep INSERT | grep -v employees | psql -U attendance

for i in "action_type" "actions" "comments" "days" "diety" "dovolene" "employees" "overtimes" "uvazky" "vacancies"; do
	echo "SELECT setval('${i}_id_seq', (select max(id) from $i)+1);" | psql -U attendance
done
