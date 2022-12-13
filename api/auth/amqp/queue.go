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

	connection, err := amqp.Dial(createDsn(
		reader.ReadAmqpConsumerHost(),
		reader.ReadAmqpConsumerUser(),
		reader.ReadAmqpConsumerPassword(),
		reader.ReadAmqpConsumerPort(),
	))

	if nil != err {
		return amqpConsumer, err
	}

	channel, err := connection.Channel()
	if nil != err {
		return amqpConsumer, err
	}

	queue, err := channel.QueueDeclare(
		reader.ReadAmqpQueueName(),
		false,
		true,
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
		return err
	}

	log.Printf("Fetched: %d messages from queue: %s", len(messages), r.queue.Name)

	for message := range messages {
		log.Printf("Consuming message id: %s", message.MessageId)

		println(message.Body)
	}

	log.Printf("Consumed: %d messages from queue: %s", len(messages), r.queue.Name)

	return err
}

func createDsn(host string, user string, password string, port int32) string {
	return fmt.Sprintf("amqp://%s:%s@%s:%d/", user, password, host, port)
}
