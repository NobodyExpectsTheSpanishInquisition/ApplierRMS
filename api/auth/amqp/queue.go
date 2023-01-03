package amqp

import (
	"auth/config"
	"fmt"
	amqp "github.com/rabbitmq/amqp091-go"
	"log"
)

const consumerTag = "AUTH_CONSUMER"

type AmqpConsumerInterface interface {
	Consume() error
}

type rabbitMqAmqpConsumer struct {
	connection *amqp.Connection
	channel    *amqp.Channel
	queue      amqp.Queue
}

func newRabbitMqAmqpConsumer(connection *amqp.Connection, channel *amqp.Channel, queue amqp.Queue) *rabbitMqAmqpConsumer {
	return &rabbitMqAmqpConsumer{connection: connection, channel: channel, queue: queue}
}

func CreateAmqpConsumer(reader config.AmqpConsumerConfigReader) (AmqpConsumerInterface, error) {
	var err error
	var amqpConsumer AmqpConsumerInterface

	connection, err := amqp.DialConfig(createDsn(
		reader.ReadAmqpConsumerHost(),
		reader.ReadAmqpConsumerUser(),
		reader.ReadAmqpConsumerPassword(),
		reader.ReadAmqpConsumerPort(),
	), amqp.Config{Properties: amqp.Table{
		"connection_name": "AUTH_MODULE",
	}})

	if nil != err {
		return amqpConsumer, err
	}

	channel, err := connection.Channel()
	if nil != err {
		return amqpConsumer, err
	}

	queue, err := channel.QueueDeclare(
		reader.ReadAmqpQueueName(),
		true,
		false,
		false,
		false,
		nil,
	)
	if nil != err {
		return amqpConsumer, err
	}

	return newRabbitMqAmqpConsumer(connection, channel, queue), err
}

func (r rabbitMqAmqpConsumer) Consume() error {
	var err error

	messages, err := r.channel.Consume(
		r.queue.Name,
		consumerTag,
		false,
		false,
		false,
		false,
		nil,
	)
	if err != nil {
		err = r.channel.Close()

		return err
	}

	log.Printf("Fetched messages from queue: %s", r.queue.Name)

	for message := range messages {
		log.Printf("Consuming message id: %s", message.MessageId)

		log.Print("Body:", string(message.Body))

		err := message.Ack(true)
		log.Print("Acked")
		if err != nil {
			log.Print(err.Error())
		}
	}

	return err
}

func createDsn(host string, user string, password string, port int32) string {
	return fmt.Sprintf("amqp://%s:%s@%s:%d/", user, password, host, port)
}
