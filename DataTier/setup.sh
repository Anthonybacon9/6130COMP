echo "Creating MongoDB database..."

sleep 10

mongosh --host data-mongo1:27017 <<EOF
var config = {
    "_id": "rs0",
    "version": 1,
    "members": [
        {
            "_id": 0,
            "host": "data-mongo1:27017",
            "priority": 2
        },
        {
            "_id": 1,
            "host": "data-mongo2:27017",
            "priority": 0
        },
        {
            "_id": 2,
            "host": "data-mongo3:27017",
            "priority": 0
        }
    ]
};
rs.initiate(config, { force: true });
EOF

sleep 5

until echo "rs.status()" | mongosh --host data-mongo1:27017 | grep -q "stateStr\ :\ PRIMARY"; do
    echo "Waiting for replica set to initialize..."
    sleep 5
done

mongosh --host data-mongo1:27017 < /database/init.js